<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteConfig;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Chia sẻ cấu hình website với tất cả view
        View::composer('*', function ($view) {
            $configs = [
                'company_name' => WebsiteConfig::get('company_name', 'Công ty cổ phần giải pháp kỹ thuật phú thái'),
                'email' => WebsiteConfig::get('email_address', 'contact@example.com'),
                'phone' => WebsiteConfig::get('phone_number', '(+84) 123-456-789'),
                'address_1' => WebsiteConfig::get('address_line_1', 'Địa chỉ công ty'),
                'address_2' => WebsiteConfig::get('address_line_2', ''),
                'facebook_url' => WebsiteConfig::get('facebook_url', '#'),
                'twitter_url' => WebsiteConfig::get('twitter_url', '#'),
                'description' => WebsiteConfig::get('description', 'Mô tả website của bạn'),
            ];
            //dd($configs);
            $view->with('config', $configs);
        });
    }
}
