<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        if (Auth::check()) {
            Cache::forget('services_page_' . $page);
        }
        $services = Cache::remember('services_page_' . $page, 60*6, function () {
            return Service::query()
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->paginate(9);
        });
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        if (Auth::check()) {
            Cache::forget('recent_services_except_' . $service->id);
        }
        $recentServices = Cache::remember('recent_services_except_' . $service->id, 60*6, function () use ($service) {
            return Service::where('id', '!=', $service->id)
                ->latest()
                ->take(5)
                ->get();
        });

        return view('services.show', compact('service', 'recentServices'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);

        if (Auth::check()) {
            Cache::forget('services_loadmore_page_' . $page);
        }
        $services = Cache::remember('services_loadmore_page_' . $page, 60*6, function () use ($page) {
            return Service::query()
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->paginate(9, ['*'], 'page', $page);
        });


        if ($services->isEmpty()) {
            return response()->json([
                'html' => '',
                'hasMore' => false
            ]);
        }

        $html = view('services._list', compact('services'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $services->hasMorePages()
        ]);
    }

    private function clearServicesCache()
    {
        Cache::tags(['services'])->flush();
    }
}
