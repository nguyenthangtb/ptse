<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('solutions.index', compact('solutions'));
    }

    public function show($slug)
    {
        $solution = Solution::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedSolutions = Solution::query()
            ->where('is_active', true)
            ->where('id', '!=', $solution->id)
            ->limit(3)
            ->get();

        return view('solutions.show', compact('solution', 'relatedSolutions'));
    }

    public function loadMore(Request $request)
    {
        $perPage = 10; // Number of items per load
        $solutions = Solution::latest()
            ->paginate($perPage, ['*'], 'page', $request->page);
    
        $html = view('solutions._list', ['solutions' => $solutions])->render();
    
        return response()->json([
            'html' => $html,
            'hasMore' => $solutions->hasMorePages()
        ]);
    }
}
