<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Add this at the top with other uses

class NewsController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $news = Cache::remember('news_page_' . $page, 60*6, function () {
            return News::query()
                ->where('is_active', true)
                ->orderBy('date', 'desc')
                ->paginate(12);
        });
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        $recentNews = Cache::remember('recent_news_except_' . $news->id, 60*6, function () use ($news) {
            return News::where('id', '!=', $news->id)
                ->latest()
                ->take(5)
                ->get();
        });
            
        return view('news.show', compact('news', 'recentNews'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $news = Cache::remember('news_loadmore_page_' . $page, 60*6, function () use ($page) {
            return News::query()
                ->where('is_active', true)
                ->orderBy('date', 'desc')
                ->paginate(12, ['*'], 'page', $page);
        });

        if ($news->isEmpty()) {
            return response()->json([
                'html' => '',
                'hasMore' => false
            ]);
        }

        $html = view('news._list', compact('news'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $news->hasMorePages()
        ]);
    }

    private function clearNewsCache()
    {
        Cache::tags(['news'])->flush();
    }
}
