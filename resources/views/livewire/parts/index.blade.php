<div class="md:flex pt-12">
    <x-parts.sidebar :categories="$categories"/>
    <div>
        <div class="border-b border-gray-100 px-5 sm:pl-8 sm:pr-0 pb-8">
            <div class="sm:flex items-center sm:space-x-4">
                <x-input
                    wire:model.live.debounce="search"
                    placeholder="Search for parts..."
                    class="sm:w-96 w-full"
                />
                <x-button wire:click="clearSearch" class="w-full mt-4 sm:mt-0 sm:w-36">Clear Search</x-button>
            </div>
        </div>
        <x-parts>
            @foreach($parts as $part)
                <x-parts.part :wire:key="$part->id" :part="$part"/>
            @endforeach
        </x-parts>
    </div>
</div>
