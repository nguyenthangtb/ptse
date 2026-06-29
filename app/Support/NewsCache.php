<?php

namespace App\Support;

use App\Models\News;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Cache;

class NewsCache
{
    private const VERSION_KEY = 'news_cache_version';

    public function version(): int
    {
        return (int) Cache::rememberForever(self::VERSION_KEY, fn (): int => 1);
    }

    public function invalidate(): void
    {
        $this->version();
        Cache::increment(self::VERSION_KEY);
    }

    public function pageKey(int $page): string
    {
        return "news:v{$this->version()}:page:{$page}";
    }

    public function loadMoreKey(int $page): string
    {
        return "news:v{$this->version()}:load-more:{$page}";
    }

    public function recentKey(int $newsId): string
    {
        return "news:v{$this->version()}:recent:{$newsId}";
    }

    public function homeKey(): string
    {
        return "news:v{$this->version()}:home";
    }

    public function expiresAt(): CarbonInterface
    {
        $maximumExpiry = now()->addHours(6);
        $nextPublication = News::query()
            ->where('is_active', true)
            ->where('published_at', '>', now())
            ->orderBy('published_at')
            ->value('published_at');

        if ($nextPublication === null) {
            return $maximumExpiry;
        }

        $nextPublication = Carbon::parse($nextPublication);

        return $nextPublication->lt($maximumExpiry)
            ? $nextPublication
            : $maximumExpiry;
    }
}
