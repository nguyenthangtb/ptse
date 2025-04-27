@extends('layouts.app')

@section('title', __('common.pump_and_valve_solutions_for_the_water_industry'))

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
