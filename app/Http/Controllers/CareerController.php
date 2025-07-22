<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    /**
     * Display a listing of careers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::active()
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('careers.index', compact('careers'));
    }

    /**
     * Display the specified career.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        // Get related job openings
        $relatedCareers = Career::active()
            ->where('id', '!=', $career->id)
            // ->where('deadline', '>=', Carbon::today())
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('careers.show', compact('career', 'relatedCareers'));
    }

    /**
     * Store a job application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $careerId
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request, $careerId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
            'linkedin' => 'nullable|url|max:255',
            'privacy_policy' => 'required|accepted',
        ]);

        $career = Career::findOrFail($careerId);

        // Handle resume upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $resumePath = $file->storeAs('applications/' . $careerId, $filename, 'public');
        }

        // Create application record
        $application = Application::create([
            'career_id' => $careerId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'linkedin' => $request->linkedin,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send notification emails
        try {
            // To applicant
            Mail::to($request->email)->send(new \App\Mail\ApplicationReceived($application, $career));

            // To admin
            Mail::to(config('mail.admin_address', 'admin@example.com'))
                ->send(new \App\Mail\NewApplication($application, $career));
        } catch (\Exception $e) {
            // Log email sending error but don't fail the request
            \Log::error('Failed to send application email: ' . $e->getMessage());
        }

        return redirect()->route('careers.thanks')->with('success', __('common.application_submitted'));
    }

    /**
     * Display the application thank you page.
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks()
    {
        return view('careers.thanks');
    }
}
