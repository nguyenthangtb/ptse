@extends('layouts.app')

@section('content')
    <nav class="bg-gray-100 py-3 mb-6">
        <div class="container mx-auto px-4">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <a href="{{ route('solutions.index') }}" class="text-gray-600 hover:text-primary">Giải pháp</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-500">{{ $solution->title }}</span>
                </li>
            </ol>
        </div>
    </nav>
    <!-- Cover Section -->
    <section class="relative h-96">
        <div class="h-full bg-gray-900">
            @if($solution->image)
            <div class="absolute inset-0 bg-cover bg-center opacity-75" 
                 style="background-image: url('{{ $solution->image }}')"></div>
            @endif
            <div class="relative h-full flex items-center justify-center bg-black/30">
                <div class="container mx-auto px-4 text-center text-white">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $solution->title }}</h1>
                    <div class="flex items-center justify-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>{{ $solution->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex gap-8">
            <!-- Main Content - 9 parts -->
            <div class="w-9/12">
                <div class="prose prose-lg max-w-none">
                    {!! $solution->description !!}
                </div>
            </div>

            <!-- Sidebar - 3 parts -->
            <div class="w-3/12">
                <div class="sticky top-4">
                    <h3 class="text-xl font-bold mb-6 text-center">Giải pháp liên quan</h3>
                    <div class="space-y-6">
                        @foreach($relatedSolutions as $related)
                        <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all">
                            <div class="h-48 overflow-hidden rounded-t-lg bg-gray-100">
                                <a href="{{ route('solutions.show', $related->slug) }}" class="block h-full">
                                    @if($related->image)
                                    <img src="{{ $related->image }}" 
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    @endif
                                </a>
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold mb-2">
                                    <a href="{{ route('solutions.show', $related->slug) }}" 
                                       class="hover:text-primary transition-colors">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $related->short_description }}</p>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection