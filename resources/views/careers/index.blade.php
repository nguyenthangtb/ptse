@extends('layouts.app')

@section('title', __('common.careers'))

@section('content')
<div class="pt-[72px] md:pt-[116px]">
    <!-- Mobile Title -->
    <div class="block lg:hidden mt-[120px] mb-8">
        <h1 class="text-3xl font-bold text-center">{{ __('common.careers') }}</h1>
    </div>

    <!-- Careers Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="hidden lg:block text-4xl font-extrabold tracking-tight text-gray-900 mb-4">{{ __('common.join_our_team') }}</h1>
                <p class="max-w-3xl mx-auto text-xl text-gray-500">
                    {{ __('common.careers_description') }}
                </p>
            </div>

        </div>
    </section>

    <!-- Current Openings Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">{{ __('common.current_openings') }}</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-500">
                    {{ __('common.openings_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6" id="jobListings">
                @if($careers && $careers->count() > 0)
                    @foreach($careers as $career)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                            <div class="p-6 md:p-8">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="mb-4 md:mb-0">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $career->title }}</h3>
                                        <div class="flex flex-wrap gap-2 md:gap-4 text-sm text-gray-600">
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
                                        </div>
                                    </div>
                                    <a href="{{ route('careers.show', $career->slug) }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#1E4ED8] hover:bg-[#1E4ED8]/90 transition-colors">
                                        {{ __('common.view_details') }}
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <p class="text-gray-600 line-clamp-2">{{ $career->short_description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-12 bg-white rounded-lg shadow">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('common.no_openings_available') }}</h3>
                        <p class="text-gray-500">{{ __('common.check_back_later') }}</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($careers && $careers->hasPages())
                <div class="mt-12">
                    {{ $careers->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Application Process Section -->
    <section class="py-12 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">{{ __('common.application_process') }}</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-500">
                    {{ __('common.application_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">1</div>
                    <svg class="w-12 h-12 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('common.apply_online') }}</h3>
                    <p class="text-gray-500">{{ __('common.apply_online_description') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">2</div>
                    <svg class="w-12 h-12 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('common.screening') }}</h3>
                    <p class="text-gray-500">{{ __('common.screening_description') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">3</div>
                    <svg class="w-12 h-12 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('common.interview') }}</h3>
                    <p class="text-gray-500">{{ __('common.interview_description') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">4</div>
                    <svg class="w-12 h-12 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('common.offer') }}</h3>
                    <p class="text-gray-500">{{ __('common.offer_description') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
