<div class="language-switcher flex items-center gap-2">
    @foreach(config('app.locales') as $locale)
        <a href="{{ localized_url($locale) }}"
           class="{{ app()->getLocale() == $locale ? 'active' : '' }} px-2 py-1 text-sm font-medium flex items-center gap-2">
            <img src="{{ asset('images/flags/' . $locale . '.png') }}" alt="{{ $locale }} flag" class="w-5 h-5">
        </a>
    @endforeach
</div>