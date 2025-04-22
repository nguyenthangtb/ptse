<ul class="flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0 w-full">
    @foreach($menuItems as $item)
        <li @class([
            'relative group menu-item' => true,
            'w-full md:w-auto' => true
        ])>
            <a href="{{ $item->children->isEmpty() ? $item->url : ($item->url != '#' ? $item->url : '#') }}"
               @if($item->children->isEmpty()) target="{{ $item->target }}" @endif
               @class([
                   'block text-white font-medium relative py-2.5 px-4 rounded-lg transition-all duration-300
                    before:absolute before:inset-0 before:border-2 before:border-transparent before:rounded-lg
                    before:transition-all before:duration-300 hover:before:border-white
                    after:absolute after:inset-0 after:scale-x-0 after:opacity-0 after:bg-white/20
                    after:rounded-lg after:transition-all after:duration-300
                    hover:after:scale-x-100 hover:after:opacity-100',
                   'flex items-center justify-between' => true,
                   'before:border-white after:scale-x-100 after:opacity-100' => request()->url() === $item->url
               ])>
                <div class="flex items-center">
                    @if($item->icon)
                        <i class="{{ $item->icon }} text-white mr-2 relative z-10"></i>
                    @endif
                    <span class="relative z-10">{{ $item->title }}</span>
                </div>
                @if($item->children->isNotEmpty())
                    <i class="fas fa-chevron-down text-white text-xs relative z-10 transition-transform duration-300 menu-arrow md:group-hover:rotate-180"></i>
                @endif
            </a>
            @if($item->children->isNotEmpty())
                <!-- Desktop Submenu -->
                <div class="hidden md:block md:absolute md:top-full md:left-0 md:mt-1 w-full md:w-[250px] invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <ul class="flex flex-col bg-[#1E4ED8] rounded-lg shadow-lg overflow-hidden">
                        @foreach($item->children as $child)
                            <li class="relative group/child submenu-item">
                                <a href="{{ $child->children && $child->children->isNotEmpty() ? '#' : $child->url }}"
                                   @if(!$child->children || $child->children->isEmpty()) target="{{ $child->target }}" @endif
                                   @class([
                                       'flex items-center py-2 px-4 text-white hover:bg-white/20 transition-all duration-300 relative justify-between',
                                       'bg-white/20' => request()->url() === $child->url
                                   ])>
                                    <div class="flex items-center">
                                        @if($child->icon)
                                            <i class="{{ $child->icon }} text-white mr-3"></i>
                                        @endif
                                        <span>{{ $child->title }}</span>
                                    </div>
                                    @if($child->children && $child->children->isNotEmpty())
                                        <i class="fas fa-chevron-right text-white text-xs menu-arrow"></i>
                                    @endif
                                </a>
                                @if($child->children && $child->children->isNotEmpty())
                                    <div class="md:absolute md:left-full md:top-0 w-[250px] invisible group-hover/child:visible opacity-0 group-hover/child:opacity-100 transition-all duration-300">
                                        <ul class="flex flex-col bg-[#1E4ED8] rounded-lg shadow-lg overflow-hidden md:ml-1">
                                            @foreach($child->children as $subChild)
                                                <li>
                                                    <a href="{{ $subChild->url }}"
                                                       target="{{ $subChild->target }}"
                                                       class="flex items-center py-2 px-4 text-white hover:bg-white/20 transition-all duration-300">
                                                        @if($subChild->icon)
                                                            <i class="{{ $subChild->icon }} text-white mr-3"></i>
                                                        @endif
                                                        <span>{{ $subChild->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Mobile Submenu -->
                <div class="mobile-submenu md:hidden overflow-hidden" style="display: none;">
                    <ul class="pl-4 mt-1 border-l-2 border-white/20">
                        @foreach($item->children as $child)
                            <li class="mb-1 submenu-item">
                                <div class="relative">
                                    <a href="{{ $child->children && $child->children->isNotEmpty() ? '#' : $child->url }}"
                                       @if(!$child->children || $child->children->isEmpty()) target="{{ $child->target }}" @endif
                                       class="flex items-center justify-between py-1.5 px-3 text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                                        <div class="flex items-center">
                                            @if($child->icon)
                                                <i class="{{ $child->icon }} text-white mr-3"></i>
                                            @endif
                                            <span>{{ $child->title }}</span>
                                        </div>
                                        @if($child->children && $child->children->isNotEmpty())
                                            <i class="fas fa-chevron-down text-white text-xs transition-transform duration-300 menu-arrow"></i>
                                        @endif
                                    </a>
                                    @if($child->children && $child->children->isNotEmpty())
                                        <div class="nested-submenu overflow-hidden" style="display: none;">
                                            <ul class="pl-4 mt-1 border-l-2 border-white/20">
                                                @foreach($child->children as $subChild)
                                                    <li class="mb-1">
                                                        <a href="{{ $subChild->url }}"
                                                           target="{{ $subChild->target }}"
                                                           class="flex items-center py-1.5 px-3 text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                                                            @if($subChild->icon)
                                                                <i class="{{ $subChild->icon }} text-white mr-3"></i>
                                                            @endif
                                                            <span>{{ $subChild->title }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </li>
    @endforeach
</ul>
