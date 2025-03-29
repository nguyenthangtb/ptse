<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->where('is_active', true)
            ->orderBy('date', 'desc')
            ->paginate(12);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        $recentNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();
            
        return view('news.show', compact('news', 'recentNews'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $news = News::query()
            ->where('is_active', true)
            ->orderBy('date', 'desc')
            ->paginate(12, ['*'], 'page', $page);

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
}
