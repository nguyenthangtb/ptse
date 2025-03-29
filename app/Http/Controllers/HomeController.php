<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cache categories for 24 hours
        $categories = Cache::remember('home_categories', 60*24, function () {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->take(6)
                ->get();
        });

        // Cache featured products for 24 hours
        $featuredProducts = Cache::remember('home_featured_products', 60*24, function () {
            return Product::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(8)
                ->get();
        });

        // Cache news for 6 hours since it's more time-sensitive
        $news = Cache::remember('home_news', 60*6, function () {
            return News::where('is_active', true)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('welcome', compact('categories', 'featuredProducts', 'news'));
    }


    public function about(){
        return view('contact');
    }


    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        try {
            // TODO: Xử lý gửi email hoặc lưu thông tin liên hệ vào database
            // Có thể tạo một model Contact để lưu thông tin

            return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi gửi thông tin. Vui lòng thử lại sau.')
                ->withInput();
        }
    }
}
