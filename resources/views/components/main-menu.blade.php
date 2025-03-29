<ul class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-8 w-full">
    @foreach($menuItems as $item)
        <li @class(['relative group' => $item->children->isNotEmpty()])>
            <a href="{{ $item->url }}"
               target="{{ $item->target }}"
               @class([
                   'block text-white font-medium relative py-2 px-3 rounded-lg transition-all duration-300
                    before:absolute before:inset-0 before:border-2 before:border-transparent before:rounded-lg
                    before:transition-all before:duration-300 hover:before:border-white
                    after:absolute after:inset-0 after:scale-x-0 after:opacity-0 after:bg-white/20
                    after:rounded-lg after:transition-all after:duration-300
                    hover:after:scale-x-100 hover:after:opacity-100',
                   'flex items-center justify-between md:justify-start' => $item->children->isNotEmpty(),
                   'before:border-white after:scale-x-100 after:opacity-100' => request()->routeIs($item->route) || request()->url() === $item->url
               ])>
                @if($item->icon)
                    <i class="{{ $item->icon }} text-white mr-2 relative z-10"></i>
                @endif
                <span class="relative z-10">{{ $item->title }}</span>
                @if($item->children->isNotEmpty())
                    <i class="fas fa-chevron-down text-white ml-2 text-xs relative z-10"></i>
                @endif
            </a>
            @if($item->children->isNotEmpty())
                <ul class="flex flex-col md:flex-row gap-4 md:gap-6 mt-2 md:absolute md:top-full md:left-0 md:bg-[#1E4ED8] md:p-4 md:rounded-lg md:shadow-lg md:min-w-[200px] md:opacity-0 md:invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                    @foreach($item->children as $child)
                        <li class="relative group">
                            <a href="{{ $child->url ?? route($child->route) }}" 
                               target="{{ $child->target }}"
                               @class([
                                   'text-white flex items-center py-2 px-3 rounded-lg transition-all duration-300 relative
                                    before:absolute before:inset-0 before:border-2 before:border-transparent before:rounded-lg
                                    before:transition-all before:duration-300 hover:before:border-white
                                    after:absolute after:inset-0 after:scale-x-0 after:opacity-0 after:bg-white/20
                                    after:rounded-lg after:transition-all after:duration-300
                                    hover:after:scale-x-100 hover:after:opacity-100',
                                   'before:border-white after:scale-x-100 after:opacity-100' => request()->routeIs($child->route) || request()->url() === $child->url
                               ])>
                                @if($child->icon)
                                    <i class="{{ $child->icon }} text-white mr-2 relative z-10"></i>
                                @endif
                                <span class="relative z-10">{{ $child->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
