<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy ngôn ngữ từ tham số 'lang' trong URL
        if ($request->has('lang')) {
            $locale = $request->lang;

            // Kiểm tra xem ngôn ngữ có hợp lệ không
            $locales = config('app.locales', [config('app.locale')]);

            // If locale is numeric, it might be an index into the locales array
            if (is_numeric($locale) && isset($locales[(int)$locale])) {
                $locale = $locales[(int)$locale];
            }

            // Check if the locale is valid
            if (in_array($locale, $locales)) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        // Nếu không có tham số 'lang', sử dụng ngôn ngữ từ session hoặc mặc định
        else {
            $locale = Session::get('locale', config('app.locale'));
            App::setLocale($locale);
        }
        return $next($request);
    }
}
