@extends('layouts.app')

@section('title', 'Giải pháp bơm & van cho ngành nước')

@section('content')
    <!-- Hero Section with Slider -->
    <x-home.hero-slider :sliders="$sliders" />

    <!-- Categories Section -->
    <x-home.categories :categories="$categories" />

    <!-- Featured Products -->
    <x-home.featured-products :featuredProducts="$featuredProducts" />

    {{-- Videos dịch vụ --}}
    <x-home.services :services="$services" />

    <!-- News Section -->
    <x-home.news :news="$news" />

    <!-- Partner Section -->
    <x-home.partners/>

    <!-- Contact Form -->
    {{-- <x-home.contact /> --}}
@endsection

@section('scripts')
    <x-home.scripts />
@endsection
