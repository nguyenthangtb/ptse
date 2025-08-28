@extends('layouts.app')

@section('title', $career->getTranslation('title', app()->getLocale()))
@section('styles')
    <style>
        .content { font-size: 16px; line-height: 1.75; color: #111827; }
        .content h1,h2,h3 { font-weight: 700; line-height: 1.6; margin: 1.6em 0 .6em; }
        .content h1 { font-size: 2rem; }
        .content h2 { font-size: 1.5rem; }
        .content h3 { font-size: 1.25rem; }

        .content p { margin: 0 0 1.25em; }
        .content ul { list-style: disc; padding-left: 1.625em; margin: 0 0 1.25em; }
        .content ol { list-style: decimal; padding-left: 1.625em; margin: 0 0 1.25em; }
        .content li { margin: .5em 0; }
        .content img { max-width: 100%; height: auto; }
    </style>
@endsection
@section('content')
    <section class="py-12 md:py-8 mt-[170px]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                        @if($career->image)
                            <div class="aspect-video w-full">
                                <img src="{{ Storage::url($career->image) }}" alt="{{ $career->getTranslation('title', app()->getLocale()) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $career->getTranslation('title', app()->getLocale()) }}</h1>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-8 border-b border-gray-100 pb-6">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $career->location }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $career->job_type }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('common.deadline') }}: {{ \Carbon\Carbon::parse($career->deadline)->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('common.salary') }}: {{ $career->salary ?? __('common.negotiable') }}
                                </span>
                            </div>

                            <!-- Summary -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900">{{ __('common.job_summary') }}</h2>
                                <div class="prose max-w-none text-gray-600">
                                    <p>{{ $career->short_description }}</p>
                                </div>
                            </div>

                            <!-- Job Description -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900">{{ __('common.job_description') }}</h2>
                                <div class="prose max-w-none">
                                    {!! $career->description !!}
                                </div>
                            </div>

                            <!-- Requirements -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900">{{ __('common.requirements') }}</h2>
                                <div class="prose max-w-none">
                                    {!! $career->requirements !!}
                                </div>
                            </div>

                            <!-- Benefits -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900">{{ __('common.benefits_description') }}</h2>
                                <div class="prose max-w-none">
                                    {!! $career->benefits !!}
                                </div>
                            </div>

                            <!-- Apply Button -->
                            <div class="pt-4 space-y-3 md:space-y-0 md:flex md:space-x-3">
                                <!-- Zalo Button -->
                                <a href="https://zalo.me/{{ $config['connect_zalo'] }}" target="_blank" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors">
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.0008 2C6.47831 2 2.00098 6.47733 2.00098 12C2.00098 17.5227 6.47831 22 12.0008 22C17.5234 22 22.0008 17.5227 22.0008 12C22.0008 6.47733 17.5234 2 12.0008 2ZM16.3174 15.7765C16.1921 15.9018 16.0385 15.9644 15.9131 15.9644C15.7877 15.9644 15.6341 15.9018 15.5088 15.7765L14.8174 15.0851C14.5667 15.3358 14.3161 15.5864 14.0654 15.8371C13.7582 16.1443 13.3883 16.193 13.0177 15.9906C11.9338 15.4008 10.9791 14.5856 10.1638 13.5767C9.34843 12.5678 8.78124 11.4423 8.47258 10.2116C8.36878 9.79082 8.49411 9.38158 8.83431 9.04138C9.0593 8.81639 9.28429 8.59141 9.50928 8.36642C9.63461 8.24109 9.76068 8.11502 9.88601 7.98969C10.1367 7.73898 10.1367 7.36611 9.88601 7.1154L8.71533 5.94472C8.46462 5.69401 8.09175 5.69401 7.84104 5.94472C7.5538 6.23196 7.25893 6.5164 6.98343 6.81126C6.75845 7.05106 6.63312 7.33753 6.60984 7.64785C6.58656 7.94654 6.58656 8.24524 6.60984 8.54393C6.84574 10.1447 7.4596 11.6594 8.42676 13.0489C9.39391 14.4383 10.6698 15.6309 12.2544 16.598C13.5388 17.3645 14.9348 17.8493 16.3591 18.0304C16.6161 18.0537 16.8731 18.053 17.1107 18.0297C17.3948 18.0064 17.6578 17.8811 17.8828 17.6561C18.1542 17.3847 18.4641 17.143 18.7355 16.8716C18.9862 16.6209 18.9862 16.2481 18.7355 15.9974L16.3174 15.7765Z"/>
                                    </svg>
                                    {{ __('common.connect_zalo') }}
                                </a>

                                <!-- Facebook Messenger Button -->
                                <a href="{{ $config['connect_facebook'] }}" target="_blank" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-[#0084FF] text-white font-medium rounded-lg hover:bg-[#0084FF]/90 transition-colors">
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.477 2 2 6.145 2 11.259C2 14.128 3.41 16.65 5.625 18.31V22L9.133 20.115C10.045 20.38 11.005 20.518 12 20.518C17.523 20.518 22 16.373 22 11.259C22 6.145 17.523 2 12 2ZM13.224 14.528L10.681 11.857L5.775 14.528L11.097 8.944L13.68 11.615L18.547 8.944L13.224 14.528Z"/>
                                    </svg>
                                    {{ __('common.connect_facebook') }}
                                </a>

                                <!-- Phone Button -->
                                <a href="tel: {{ $config['phone'] }}" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ __('common.call_phone') }}
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Application Form -->
                    {{-- <div id="apply-form" class="bg-white rounded-lg shadow-sm overflow-hidden mt-8">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold mb-6 text-gray-900">{{ __('common.apply_for_position') }}</h2>
                            <form action="{{ route('careers.apply', $career->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <input type="hidden" name="career_id" value="{{ $career->id }}">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.full_name') }} *</label>
                                        <input type="text" name="name" id="name" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.email') }} *</label>
                                        <input type="email" name="email" id="email" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.phone') }} *</label>
                                        <input type="tel" name="phone" id="phone" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>

                                    <div>
                                        <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.linkedin_profile') }}</label>
                                        <input type="url" name="linkedin" id="linkedin" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div>
                                    <label for="resume" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.upload_resume') }} (PDF, DOC, DOCX) *</label>
                                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div>
                                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-1">{{ __('common.cover_letter') }}</label>
                                    <textarea name="cover_letter" id="cover_letter" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="privacy_policy" id="privacy_policy" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" required>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="privacy_policy" class="font-medium text-gray-700">{{ __('common.privacy_policy_agreement') }} *</label>
                                        <p class="text-gray-500">{{ __('common.privacy_policy_description') }}</p>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#1E4ED8] hover:bg-[#1E4ED8]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        {{ __('common.submit_application') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                        <h2 class="text-xl font-bold mb-6 pb-4 border-b border-gray-100">{{ __('common.other_openings') }}</h2>
                        <div class="space-y-6">
                            @if(isset($relatedCareers) && $relatedCareers->count() > 0)
                                @foreach($relatedCareers as $item)
                                    <div class="group">
                                        <a href="{{ route('careers.show', $item->slug) }}" class="flex gap-4">
                                            <div class="flex-1">
                                                <h3 class="font-medium text-gray-900 group-hover:text-[#1E4ED8] transition-colors line-clamp-2">
                                                    {{ $item->getTranslation('title', app()->getLocale()) }}
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">{{ $item->location }}</p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ __('common.deadline') }}: {{ \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500">{{ __('common.no_other_openings') }}</p>
                            @endif
                        </div>

                        <!-- Company Contact Info -->
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-semibold mb-4">{{ __('common.contact_us') }}</h3>
                            <div class="space-y-3">
                                <p class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-gray-600">{{ $config['phone'] }}</span>
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-600">{{ $config['email'] }}</span>
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-gray-600">{{ __('common.address_2') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
