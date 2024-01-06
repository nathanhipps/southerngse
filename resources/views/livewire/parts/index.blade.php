<div class="flex pt-12">
    <x-parts.sidebar :categories="$categories"/>
    <div>
        <div class="border-b border-gray-100 pl-8 pb-8">
            <div class="flex items-center space-x-4">
                <x-input
                    wire:model.live.debounce="search"
                    placeholder="Search for parts..."
                    class="w-96"
                />
                <x-button>Clear Search</x-button>
            </div>
        </div>
        <x-parts>
            @foreach($parts as $part)
                <x-parts.part :part="$part"/>
            @endforeach
        </x-parts>
    </div>
</div>
