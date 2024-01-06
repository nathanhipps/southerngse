<div class=" min-w-64 max-w-80 flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a href="{{ route('parts', ['category' => '']) }}"
                            @class([
                                'text-sm font-semibold p-2 rounded-md leading-6 gap-x-3 group flex',
                                'bg-gray-50 text-indigo-600' => request()->category === '' || request()->category === null,
                                'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' => request()->category !== '' || request()->category !== null,
                            ])
                        >
                            <x-icons.infinity class="w-5 h-5"/>
                            All Parts
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                            <a href="{{ route('parts', ['category' => $category->name]) }}"
                                @class([
                                    'text-sm font-semibold p-2 rounded-md leading-6 gap-x-3 group flex',
                                    'bg-gray-50 text-indigo-600' => request()->category === $category->name,
                                    'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' => request()->category !== $category->name,
                                ])
                            >
                                <x-dynamic-component
                                    class="w-5 h-5"
                                    :component="'icons.'.$category->icon"
                                />

                                {{ $category->name }}
                                <span
                                    class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-white px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-gray-600 ring-1 ring-inset ring-gray-200"
                                    aria-hidden="true">{{ $category->parts_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
</div>
