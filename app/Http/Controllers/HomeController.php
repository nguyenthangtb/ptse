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
use App\Models\Introduce;
use App\Models\WebsiteConfig;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInformation;

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
                ->take(6)
                ->get();
        });

        // Cache services (videos) for 24 hours
        $services = Cache::remember('home_services', 60*24, function () {
            return Service::active()
                ->orderBy('order')
                ->take(6)
                ->get();
        });

        $sliders = Cache::remember('home_sliders', 60*24, function () {
            return HomeSlider::active()
                ->orderBy('order')
                ->take(3)
                ->get();
        });


        return view('welcome', compact('categories', 'featuredProducts', 'news', 'services', 'sliders'));
    }

    public function about(){
        return view('contact');
    }

    public function gioiThieu(){
        $introduces = Introduce::where('status', 1)
            ->orderBy('section')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('section');


        return view('about', compact('introduces'));
    }


    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        try {
            // Lưu thông tin liên hệ vào cơ sở dữ liệu
            $contact = new Contact();
            $contact->name = $validated['name'];
            $contact->email = $validated['email'];
            $contact->phone = $validated['phone'];
            $contact->message = $validated['message'];
            $contact->save();

            // Gửi email thông báo
            $adminEmail = config('mail.admin_address');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactInformation($contact->toArray()));
            }
            //ajax
            return response()->json(['status' => 200, 'message' => 'Gửi thông tin thành công!']);
        } catch (\Exception $e) {
            Log::error('Failed to send contact email', [
                'message' => $e->getMessage(),
                'email' => $request->input('email'),
            ]);

            return response()->json(['status' => 500,'message' => 'Đã xảy ra lỗi khi gửi thông tin. Vui lòng thử lại sau.']);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $locale = app()->getLocale();

        $products = Product::where('is_active', true)
            ->where(function($query) use ($search, $locale) {
                $query->whereRaw("json_extract(name, '$.{$locale}') LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("json_extract(description, '$.{$locale}') LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("json_extract(short_description, '$.{$locale}') LIKE ?", ["%{$search}%"])
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->get();

        return view('search', compact('products', 'search'));
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $locale = app()->getLocale();

        $results = Product::where('is_active', true)
            ->where(function($query) use ($term, $locale) {
                $query->whereRaw("json_extract(name, '$.{$locale}') LIKE ?", ["%{$term}%"])
                    ->orWhere('name', 'like', "%{$term}%");
            })
            ->limit(10)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'label' => $product->name,
                    'value' => $product->name,
                    'slug' => $product->slug
                ];
            });

        return response()->json($results);
    }
}
