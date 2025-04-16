<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Contact;
use App\Models\HomeSlider;

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

        // Cache services (videos) for 24 hours
        $services = Cache::remember('home_services', 60*24, function () {
            return Service::active()
                ->orderBy('order')
                ->take(4)
                ->get();
        });

        $sliders = Cache::remember('home_sliders', 60*24, function () {
            return HomeSlider::active()
                ->orderBy('order')
                ->take(4)
                ->get();
        });

        return view('welcome', compact('categories', 'featuredProducts', 'news', 'services', 'sliders'));
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
            // Lưu thông tin liên hệ vào cơ sở dữ liệu
            $contact = new Contact();
            $contact->name = $validated['name'];
            $contact->email = $validated['email'];
            $contact->phone = $validated['phone'];
            $contact->message = $request->input('message');
            $contact->save();
            //ajax
            return response()->json(['status' => 200, 'message' => 'Gửi thông tin thành công!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 500,'message' => 'Đã xảy ra lỗi khi gửi thông tin. Vui lòng thử lại sau.']);
        }
    }
}
