<?php

namespace App\Observers;

use App\Models\News;
use App\Support\NewsCache;

class NewsObserver
{
    public function __construct(private readonly NewsCache $newsCache) {}

    public function saved(News $news): void
    {
        $this->newsCache->invalidate();
    }

    public function deleted(News $news): void
    {
        if (! $news->isForceDeleting()) {
            $this->newsCache->invalidate();
        }
    }

    public function restored(News $news): void
    {
        $this->newsCache->invalidate();
    }

    public function forceDeleted(News $news): void
    {
        $this->newsCache->invalidate();
    }
}
