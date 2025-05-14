@extends('layouts.app')

@section('title', __('common.application_submitted'))

@section('content')
<div class="py-12 md:pt-[170px]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-8 md:p-12 text-center">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ __('common.thank_you_for_applying') }}</h1>
                <p class="text-lg text-gray-600 mb-6">
                    {{ __('common.application_received_message') }}
                </p>

                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h2 class="text-lg font-semibold text-blue-800 mb-2">{{ __('common.whats_next') }}</h2>
                    <ul class="space-y-4 text-left">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('common.confirmation_email_sent') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('common.application_review_message') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('common.interview_process_message') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('careers.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#1E4ED8] hover:bg-[#1E4ED8]/90 transition-colors">
                    {{ __('common.view_more_openings') }}
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    {{ __('common.return_to_home') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
