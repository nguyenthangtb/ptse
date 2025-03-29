<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('products.index', compact('products'));
    }

    public function productCategory(Category $category, Request $request)
    {
        $products = Product::where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

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
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Add to cart logic here
        // You might want to use a cart package or implement your own cart system

        return response()->json([
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
            'cart_count' => 1 // Replace with actual cart count
        ]);
    }
}
