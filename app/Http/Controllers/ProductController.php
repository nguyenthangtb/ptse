<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = request()->get('page', 1);
        $products = Cache::remember('products_page_' . $page, 60*24, function () {
            return Product::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        });

        $categories = Cache::remember('all_categories', 60*24, function () {
            return Category::orderBy('order', 'asc')
                ->get();
        });
        if ($request->ajax()) {
            $view = view('products.partials._list', compact('products'))->render();
            return response()->json([
                'html' => $view,
                'hasMore' => $products->hasMorePages()
            ]);
        }

        return view('products.index', compact('products', 'categories'));
    }

    public function productCategory(Category $category, Request $request)
    {
        $page = $request->get('page', 1);
        $products = Cache::remember('category_products_' . $category->id . '_page_' . $page, 60*24, function () use ($category) {
            return Product::where('category_id', $category->id)
                ->latest()
                ->paginate(12);
        });

        $categories = Cache::remember('all_categories', 60*24, function () {
            return Category::all();
        });

        if ($request->ajax()) {
            $view = view('products.partials._list', compact('products'))->render();
            return response()->json([
                'html' => $view,
                'hasMore' => $products->hasMorePages()
            ]);
        }

        return view('products.category', compact('products', 'categories', 'category'));
    }

    public function show($slug)
    {
        $product = Cache::remember('product_' . $slug, 60*24, function () use ($slug) {
            return Product::query()
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $relatedProducts = Cache::remember('related_products_' . $product->id, 60*24, function () use ($product) {
            return Product::query()
                ->where('is_active', true)
                ->where('id', '!=', $product->id)
                ->limit(4)
                ->get();
        });

        return view('products.show', compact('product', 'relatedProducts'));
    }

    private function clearProductCache($product)
    {
        Cache::forget('product_' . $product->slug);
        Cache::forget('related_products_' . $product->id);
        Cache::forget('category_products_' . $product->category_id);
        Cache::forget('all_categories');
        
        // Clear paginated caches
        for ($i = 1; $i <= 10; $i++) { // Adjust the number based on your typical page count
            Cache::forget('products_page_' . $i);
            Cache::forget('category_products_' . $product->category_id . '_page_' . $i);
        }
    }
}
