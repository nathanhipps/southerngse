<div class="mt-8">
    <ul role="list" class="divide-y divide-gray-100">
        @foreach($orders as $order)
            <li class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            {{ $order->number }}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                        <p class="whitespace-nowrap">
                            {{ $order->address->street}}
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $orders->links() }}

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
