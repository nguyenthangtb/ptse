<?php

namespace Tests\Feature;

use App\Models\News;
use App\Support\NewsCache;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class NewsCacheTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'cache.default' => 'array',
            'database.default' => 'sqlite',
            'database.connections.sqlite' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
        ]);

        DB::purge('sqlite');
        Cache::flush();

        Schema::create('news', function (Blueprint $table): void {
            $table->id();
            $table->text('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->timestamp('date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_news_changes_invalidate_versioned_cache_without_flushing_other_cache(): void
    {
        $newsCache = app(NewsCache::class);
        Cache::forever('unrelated_product_cache', 'kept');

        $this->assertSame(1, $newsCache->version());
        $this->assertSame('news:v1:page:2', $newsCache->pageKey(2));

        $news = $this->createNews();
        $afterCreate = $newsCache->version();

        $news->update(['is_active' => false]);
        $afterUpdate = $newsCache->version();

        $news->delete();
        $afterDelete = $newsCache->version();

        $news->restore();
        $afterRestore = $newsCache->version();

        $news->forceDelete();
        $afterForceDelete = $newsCache->version();

        $this->assertGreaterThan(1, $afterCreate);
        $this->assertGreaterThan($afterCreate, $afterUpdate);
        $this->assertGreaterThan($afterUpdate, $afterDelete);
        $this->assertGreaterThan($afterDelete, $afterRestore);
        $this->assertGreaterThan($afterRestore, $afterForceDelete);
        $this->assertSame('kept', Cache::get('unrelated_product_cache'));
        $this->assertSame("news:v{$afterForceDelete}:home", $newsCache->homeKey());
    }

    public function test_cache_expires_when_the_next_scheduled_active_news_is_published(): void
    {
        Carbon::setTestNow('2026-06-29 08:00:00');

        $this->createNews([
            'slug' => 'scheduled-news',
            'published_at' => now()->addMinutes(30),
        ]);

        $this->assertTrue(
            app(NewsCache::class)->expiresAt()->equalTo(now()->addMinutes(30))
        );
    }

    public function test_cache_expires_after_six_hours_when_there_is_no_scheduled_news(): void
    {
        Carbon::setTestNow('2026-06-29 08:00:00');

        $this->assertTrue(
            app(NewsCache::class)->expiresAt()->equalTo(now()->addHours(6))
        );
    }

    private function createNews(array $attributes = []): News
    {
        return News::create(array_merge([
            'title' => ['vi' => 'Tin thử nghiệm'],
            'slug' => 'tin-thu-nghiem',
            'content' => ['vi' => 'Nội dung thử nghiệm'],
            'date' => now(),
            'published_at' => now(),
            'is_active' => true,
        ], $attributes));
    }
}
