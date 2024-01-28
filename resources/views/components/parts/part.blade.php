@props(['part'])

<div {{ $attributes }} class="group relative border-b border-r border-gray-200 p-4 sm:p-6">
    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
        @if ($part->image_path)
            <img src="https://southern-gse.nyc3.digitaloceanspaces.com/{{ $part->image_path }}"
                 alt="{{ $part->description }}" class="h-full w-full object-cover object-center">
        @else
            <img
                src="https://images.unsplash.com/photo-1610642372651-fe6e7bc209ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300"
                alt="{{ $part->description }}" class="h-full w-full object-cover object-center">
        @endif
    </div>
    <div class="pb-4 pt-10 text-center">
        <h2 class="font-semibold text-lg">
            <span>
                {{ $part->sku }}
            </span>
        </h2>
        <div class="relative z-10">
            <x-button
                wire:click="addToCart({{ $part->id }})"
                class="my-2"
            >
                <x-icons.shopping-cart class="w-6 h-6"/>
            </x-button>
        </div>

        <h3 class="text-sm font-medium text-gray-900">
            <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{ $part->description }}
            </a>
        </h3>
        <p class="mt-4 text-base font-medium text-gray-900">
            {{ $part->displayPrice }}
        </p>

    </div>
</div>

