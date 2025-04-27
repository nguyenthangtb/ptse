@foreach($projects as $project)
    <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all group">
        <div class="h-64 overflow-hidden rounded-t-lg">
            <a href="{{ route('projects.show', $project->slug) }}" class="block h-full">
                @if($project->image)
                    <img src="{{ Storage::url($project->image) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @endif
            </a>
        </div>
        <div class="p-6">
            <h3 class="font-semibold text-xl mb-3 group-hover:text-primary transition-colors">
                <a href="{{ route('projects.show', $project->slug) }}">
                    {{ $project->title }}
                </a>
            </h3>
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                @if($project->client)
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        {{ $project->client }}
                    </div>
                @endif
                @if($project->location)
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $project->location }}
                    </div>
                @endif
            </div>
            <p class="text-gray-600 line-clamp-3 mb-4">{{ $project->short_description }}</p>
            <a href="{{ route('projects.show', $project->slug) }}"
               class="inline-flex items-center text-sm text-primary hover:text-primary/80 font-medium">
                {{ __('common.read_more') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </article>
@endforeach