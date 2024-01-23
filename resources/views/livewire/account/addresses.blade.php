<div class="mt-8">
    <x-button
        wire:click="startNewAddress"
    >
        New Address
    </x-button>
    <ul role="list" class="divide-y divide-gray-100">
        @foreach($addresses as $address)
            <li class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            {{ $address->name }}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                        <p class="whitespace-nowrap">
                            {{ $address->street }}<br>
                            {{ $address->details }}<br>
                            {{ $address->city }}, {{ $address->state }} {{ $address->zip }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                    <button
                        wire:click="deleteAddress({{ $address->id }})"
                        wire:confirm="Are you sure you want to delete this address"
                        class="hidden rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-gray-100 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-800 sm:block"
                    >
                        Delete
                    </button>
                </div>
            </li>
        @endforeach
    </ul>

    <x-slideover wire:model="slider">
        <x-slideover.header>
            <div class="flex space-x-2 text-gray-600 items-center">
                <span>
                    New Address
                </span>
            </div>
        </x-slideover.header>

        <div class="px-5">
            <livewire:account.address-form/>
        </div>
    </x-slideover>
</div>
