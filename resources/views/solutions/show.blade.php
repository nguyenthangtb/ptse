@extends('layouts.app')

@section('content')
    <section class="py-12 md:py-8 mt-[170px]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="grid gap-4 pl-4 pr-4">
                            @if($solution->image)
                            <div>
                                <img class="w-full h-full rounded-lg object-cover" src="{{ Storage::url($solution->image) }}" alt="">
                            </div>
                            @endif
                            <div class="grid grid-cols-5 gap-4">
                                @if($solution->gallery)
                                    @foreach($solution->gallery as $image)
                                        <div>
                                            <a href="{{ Storage::url($image) }}" data-lightbox="gallery" data-title="{{ $solution->title }}">
                                                <img class="h-auto max-w-full rounded-lg" src="{{ Storage::url($image) }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="p-6">
                            <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $solution->title }}</h1>
                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-8 border-b border-gray-100 pb-6">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $solution->created_at->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="prose max-w-none">
                                {{-- {!! str($solution->description)->sanitizeHtml() !!} --}}
                                {!! $solution->description !!}
                            </div>

                            <!-- Social Share -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <h3 class="text-lg font-semibold mb-4">{{ __('common.share_post') }}</h3>
                                <div class="flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($solution->title) }}"
                                    target="_blank"
                                    class="bg-sky-500 text-white p-2 rounded-full hover:bg-sky-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.58v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 sticky">
                    <div class="border rounded-lg bg-white shadow-sm">
                        <div class="p-4">
                            <h2 class="text-xl font-bold pb-4 border-b border-gray-100">{{ __('common.documents') }}</h2>
                        </div>
                        <div class="divide-y">
                            @if($solution->documents && is_array($solution->documents))
                                @foreach($solution->documentUrls as $document)
                                    @php
                                        $filename = $document['original_name'];
                                        $extension = $document['extension'];
                                        $fileIcon = match(strtolower($extension)) {
                                            'pdf' => '<svg class="w-6 h-6 text-red-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'doc', 'docx' => '<svg class="w-6 h-6 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'xls', 'xlsx' => '<svg class="w-6 h-6 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            'zip', 'rar', '7z' => '<svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>',
                                            default => '<svg class="w-6 h-6 text-gray-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>'
                                        };
                                        $fileSize = $document['size'] > 0 ? round($document['size'] / 1024, 2) . ' KB' : '';
                                    @endphp
                                    <div class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                {!! $fileIcon !!}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-900 truncate">
                                                    {{ $filename }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ strtoupper($extension) }} {{ $fileSize ? ' · ' . $fileSize : '' }}
                                                </p>
                                            </div>
                                            <div>
                                                <a href="{{ $document['url'] }}"
                                                  class="inline-flex items-center px-3 py-1.5 border border-[#1E4ED8] rounded-lg text-xs font-medium text-[#1E4ED8] hover:bg-[#1E4ED8] hover:text-white transition-colors"
                                                  target="_blank">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                    {{ __('common.download') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-3 px-4">
                                    <p class="text-sm text-gray-500">{{ __('common.no_documents') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24 mt-4">
                        <h2 class="text-xl font-bold mb-6 pb-4 border-b border-gray-100">{{ __('common.related_solutions') }}</h2>
                        <div class="space-y-6">
                            @foreach($relatedSolutions as $related)
                                <div class="group">
                                    <a href="{{ route('solutions.show', $related->slug) }}" class="flex gap-4">
                                        @if($related->image)
                                            <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}"
                                                class="w-24 h-24 rounded-lg object-cover flex-shrink-0 group-hover:opacity-90 transition-opacity">
                                        @else
                                            <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <h3 class="font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                                {{ $related->title }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $related->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
