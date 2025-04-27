@foreach($solutions as $solution)
    <article class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition-all">
        <!-- Image Container -->
        <div class="aspect-[4/3] w-full overflow-hidden">
            @if($solution->image && !empty(trim($solution->image)))
                <img src="{{ $solution->image }}"
                        alt="{{ $solution->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <div class="relative w-16 h-16">
                        <div class="absolute inset-0 border-4 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                        <div class="absolute inset-2 border-4 border-t-transparent border-r-primary border-b-transparent border-l-transparent rounded-full animate-spin-reverse"></div>
                        <div class="absolute inset-[30%] bg-primary rounded-full opacity-50"></div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Content Container -->
        <div class="p-6">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                {{ $solution->created_at->format('d/m/Y') }}
            </div>
            <h3 class="font-semibold text-xl mb-3 group-hover:text-primary transition-colors line-clamp-2">
                <a href="{{ route('solutions.show', $solution->slug) }}">
                    {{ $solution->title }}
                </a>
            </h3>
            <p class="text-gray-600 mb-4 line-clamp-3">{{ $solution->short_description }}</p>
            <a href="{{ route('solutions.show', $solution->slug) }}"
                class="inline-flex items-center text-sm text-primary hover:text-primary/80 font-medium">
                {{ __('common.read_more') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </article>
@endforeach