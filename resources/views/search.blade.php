@extends('layouts.app')

@section('title', __('common.search_results') . ': ' . $search)

@section('content')
<div class="container mx-auto px-4 py-8 mt-32">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">{{ __('common.search_results') }}: "{{ $search }}"</h1>

        @if($products->count() > 0)
            <p class="mb-4">{{ __('common.found') }} {{ $products->count() }} {{ __('common.results') }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <a href="{{ route('products.show', $product->slug) }}">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400"><i class="fas fa-image text-3xl"></i></span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-blue-50 p-6 rounded-lg shadow-sm">
                <p class="text-lg">{{ __('common.no_results_found') }} "{{ $search }}"</p>
                <p class="mt-2 text-gray-600">{{ __('common.please_try_again_with_different_keywords') }} {{ __('common.or_view_our_products') }}.</p>
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        {{ __('common.back_to_home') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .ui-autocomplete {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 9999 !important;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .ui-menu-item {
        padding: 0 !important;
    }

    .ui-menu-item-wrapper {
        padding: 8px 12px !important;
    }

    .ui-state-active {
        background-color: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }

    /* Line clamp for descriptions */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
