<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SolutionController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $solutions = Cache::remember('solutions_page_' . $page, 60*24, function () {
            return Solution::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        });

        return view('solutions.index', compact('solutions'));
    }

    public function show($slug)
    {
        $solution = Cache::remember('solution_' . $slug, 60*24, function () use ($slug) {
            return Solution::query()
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $relatedSolutions = Cache::remember('related_solutions_' . $solution->id, 60*24, function () use ($solution) {
            return Solution::query()
                ->where('is_active', true)
                ->where('id', '!=', $solution->id)
                ->limit(3)
                ->get();
        });

        return view('solutions.show', compact('solution', 'relatedSolutions'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->page;
        $solutions = Cache::remember('solutions_loadmore_page_' . $page, 60*24, function () use ($request) {
            $perPage = 10;
            return Solution::latest()
                ->paginate($perPage, ['*'], 'page', $request->page);
        });
    
        $html = view('solutions._list', ['solutions' => $solutions])->render();
    
        return response()->json([
            'html' => $html,
            'hasMore' => $solutions->hasMorePages()
        ]);
    }

    private function clearSolutionCache($solution)
    {
        // Clear individual solution cache
        Cache::forget('solution_' . $solution->slug);
        
        // Clear related solutions cache
        Cache::forget('related_solutions_' . $solution->id);
        
        // Clear paginated pages cache
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget('solutions_page_' . $i);
            Cache::forget('solutions_loadmore_page_' . $i);
        }
    }
}
