<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Support\NewsCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index(NewsCache $newsCache)
    {
        $page = request()->get('page', 1);

        $news = Cache::remember($newsCache->pageKey($page), $newsCache->expiresAt(), function () {
            return News::query()
                ->published()
                ->orderByDesc('published_at')
                ->orderByDesc('date')
                ->paginate(12);
        });

        $hasMorePages = $news->hasMorePages();

        return view('news.index', compact('news', 'hasMorePages'));
    }

    public function show(News $news, NewsCache $newsCache)
    {
        abort_unless(
            $news->is_active && $news->published_at?->lte(now()),
            404
        );

        $recentNews = Cache::remember($newsCache->recentKey($news->id), $newsCache->expiresAt(), function () use ($news) {
            return News::query()
                ->published()
                ->where('id', '!=', $news->id)
                ->orderByDesc('published_at')
                ->orderByDesc('date')
                ->take(5)
                ->get();
        });

        return view('news.show', compact('news', 'recentNews'));
    }

    public function loadMore(Request $request, NewsCache $newsCache)
    {
        $page = $request->input('page', 1);

        $news = Cache::remember($newsCache->loadMoreKey($page), $newsCache->expiresAt(), function () use ($page) {
            return News::query()
                ->published()
                ->orderByDesc('published_at')
                ->orderByDesc('date')
                ->paginate(12, ['*'], 'page', $page);
        });

        if ($news->isEmpty()) {
            return response()->json([
                'html' => '',
                'hasMore' => false,
            ]);
        }

        $html = view('news._list', compact('news'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $news->hasMorePages(),
        ]);
    }
}
