@extends('layouts.app')

@section('content')
    <div class="pt-[72px] md:pt-[116px]">
        <!-- Mobile Title -->
        <div class="block lg:hidden mt-[120px] mb-8 px-4">
            <h1 class="text-2xl md:text-3xl font-bold text-center">{{ __('common.contact_us') }}</h1>
            <p class="text-gray-600 text-center mt-2">{{ __('common.contact_us_message') }}</p>
        </div>
        <!-- Contact Section -->
        <section class="py-8 mt-8 bg-gradient-to-br from-gray-50 via-white to-gray-50">
            <div class="container mx-auto px-4">
                <!-- Desktop Title -->
                <div class="hidden lg:block max-w-xl mx-auto text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ __('common.contact_us') }}</h1>
                    <p class="text-gray-600">{{ __('common.contact_us_message') }}</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                    <!-- Map & Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow">
                        <div class="mb-6">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=YOUR_EMBED_URL"
                                class="w-full h-[400px] rounded-lg shadow-sm"
                                style="border:0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">{{ __('common.address') }}</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ $config['address_1'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">{{ __('common.phone') }}</h3>
                                    <p class="text-gray-600">{{ $config['phone'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary flex-shrink-0 mt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">{{ __('common.email') }}</h3>
                                    <p class="text-gray-600">{{ $config['email'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-xl shadow-lg p-8 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-shadow">
                        <h2 class="text-2xl font-semibold mb-6">{{ __('common.send_contact_information') }}</h2>
                        <form class="space-y-6 ajaxForm">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.name') }}</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                       placeholder="{{ __('common.enter_name') }}">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.email') }}</label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                       placeholder="{{ __('common.enter_email') }}">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.phone') }}</label>
                                <input type="tel"
                                       name="phone"
                                       id="phone"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                       placeholder="{{ __('common.enter_phone') }}">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">{{ __('common.content') }}</label>
                                <textarea name="message"
                                          id="message"
                                          rows="5"
                                          required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                          placeholder="{{ __('common.enter_content') }}"></textarea>
                            </div>

                            <button type="submit"
                                    class="w-full px-6 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-all transform hover:-translate-y-0.5">
                                {{ __('common.send_contact') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script>
// Initialize Notyf
const notyf = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top'
    }
});
$(document).ready(function() {
    $('.ajaxForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/lien-he',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 200) {
                    notyf.success(response.message);
                    $('.ajaxForm')[0].reset();
                } else {
                    notyf.error(response.message);
                }
            },
            error: function(xhr) {
                notyf.error(response.message);
            }
        });
    });
});
</script>
@endsection
