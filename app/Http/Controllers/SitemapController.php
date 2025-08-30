<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\News;
use App\Models\Service;
use App\Models\Project;
use App\Models\Solution;
use App\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

final class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = Cache::remember('sitemap.urls', 60 * 12, function (): array {
            return $this->buildUrls();
        });

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function buildUrls(): array
    {
        $now = now()->toAtomString();
        $urls = [];

        // Static pages (tuỳ chỉnh theo site bạn)
        $urls[] = $this->url(URL::to('/'), $now, 'daily', '1.0');
        $urls[] = $this->url(URL::to('/gioi-thieu'), $now, 'monthly', '0.6');
        $urls[] = $this->url(URL::to('/lien-he'), $now, 'monthly', '0.5');

        // Products
        $urls[] = $this->url(Route::has('products.index') ? route('products.index') : URL::to('/san-pham'), $now, 'daily', '0.9');

        Category::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('products.category') ? route('products.category', $row->slug) : URL::to('/san-pham/danh-muc/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'weekly', '0.7');
            }
        });

        Product::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('products.show') ? route('products.show', $row->slug) : URL::to('/san-pham/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'weekly', '0.8');
            }
        });

        // News
        $urls[] = $this->url(Route::has('news.index') ? route('news.index') : URL::to('/tin-tuc'), $now, 'daily', '0.7');
        News::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('news.show') ? route('news.show', $row->slug) : URL::to('/tin-tuc/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'weekly', '0.6');
            }
        });

        // Services
        $urls[] = $this->url(Route::has('services.index') ? route('services.index') : URL::to('/dich-vu'), $now, 'weekly', '0.6');
        Service::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('services.show') ? route('services.show', $row->slug) : URL::to('/dich-vu/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'monthly', '0.5');
            }
        });

        // Projects
        $urls[] = $this->url(Route::has('projects.index') ? route('projects.index') : URL::to('/du-an'), $now, 'weekly', '0.6');
        Project::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('projects.show') ? route('projects.show', $row->slug) : URL::to('/du-an/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'monthly', '0.5');
            }
        });

        // Solutions
        $urls[] = $this->url(Route::has('solutions.index') ? route('solutions.index') : URL::to('/giai-phap'), $now, 'weekly', '0.6');
        Solution::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('solutions.show') ? route('solutions.show', $row->slug) : URL::to('/giai-phap/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'monthly', '0.5');
            }
        });

        // Pages
        Page::query()->select(['slug','updated_at'])->orderBy('id')->chunk(500, function ($rows) use (&$urls) {
            foreach ($rows as $row) {
                $loc = Route::has('pages.show') ? route('pages.show', $row->slug) : URL::to('/pages/'.$row->slug);
                $urls[] = $this->url($loc, optional($row->updated_at)->toAtomString(), 'monthly', '0.4');
            }
        });

        return $urls;
    }

    private function url(string $loc, ?string $lastmod, string $changefreq, string $priority): array
    {
        return [
            'loc' => $loc,
            'lastmod' => $lastmod ?? now()->toAtomString(),
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }
}
