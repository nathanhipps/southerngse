@php use Illuminate\Support\Str; @endphp
<div class="bg-gray-50">
    <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl ">
            <a class="hover:underline text-gray-600" href="{{ route('cart') }}">Cart</a>
            <span>/</span>
            <span>Checkout</span>
        </h2>

        <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <div>
                <div class="mt-10 border-t border-gray-200 pt-10">

                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>
                        <select
                            wire:model.live="address_id"
                            id="address"
                            name="location"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-green-600 sm:text-sm sm:leading-6"
                        >
                            <option value="">Select Address</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->name }} - {{ $address->street }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <button
                        type="button"
                        class="mt-2 rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                    >
                        Add Address
                    </button>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">

                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Credit Card</h2>
                        <select
                            wire:model.live="card_id"
                            id="card"
                            name="card"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-green-600 sm:text-sm sm:leading-6"
                        >
                            <option value="">Select Credit Card</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}">
                                    {{ $card->brand }} ({{ $card->last_four }})
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <button
                        type="button"
                        class="mt-2 rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                    >
                        Add Card
                    </button>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Freight Carrier</h2>
                        @if ($carriers->count())
                            <div>
                                <select
                                    wire:model.live="carrier_id"
                                    id="card"
                                    name="card"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-green-600 sm:text-sm sm:leading-6"
                                >
                                    <option value="">Select Freight Carrier</option>
                                    @foreach($carriers as $carrier)
                                        <option value="{{ $carrier->id }}">
                                            {{ $carrier->name }} ({{ str($carrier->account_number)->substr(-4, 4)  }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <span class="block">UPS</span>
                        @endif
                    </label>
                    <button
                        type="button"
                        class="mt-2 rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                    >
                        Add Carrier
                    </button>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Delivery Time</h2>
                        <div>
                            <select
                                wire:model.live="deliveryTime"
                                id="delviery-time"
                                name="delviery-time"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-green-600 sm:text-sm sm:leading-6"
                            >
                                <option value="">Select Delivery Time</option>
                                <option value="ground">Ground</option>
                                <option value="asap">ASAP</option>
                            </select>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Order summary -->
            <div class="mt-10 lg:mt-0">
                <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                    <h3 class="sr-only">Items in your cart</h3>
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($items as $key => $item)
                            <li class="flex px-4 py-6 sm:px-6">
                                <div class="flex-shrink-0">
                                    <img
                                        src="{{ $item->part->image_path }}"
                                        alt="{{ $item->part->description }}"
                                        class="w-20 rounded-md"
                                    >
                                </div>

                                <div class="ml-6 flex flex-1 flex-col">
                                    <div class="flex">
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-sm">
                                                {{ $item->part->sku }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $item->part->description }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex flex-1 items-end justify-between pt-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                            {{ displayCurrency($item->part->price) }}
                                        </p>

                                        <div class="ml-4">
                                            Qty: {{ $item->quantity }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ displayCurrency($cart->subtotal()) }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Shipping</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ displayCurrency($cart->shippingEstimate()) }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Taxes</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ $cart->taxEstimate() ? $cart->taxEstimate() : 'Taxes will be calculated during shipment' }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                            <dt class="text-base font-medium">Total</dt>
                            <dd class="text-base font-medium text-gray-900">
                                {{ displayCurrency($cart->total()) }}
                            </dd>
                        </div>
                    </dl>

                    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                        <form wire:submit.prevent="submit">
                            <button
                                type="submit"
                                @if (!$canSubmit) disabled @endif
                                @class([
                                    'w-full rounded-md border border-transparent px-4 py-3 text-base font-medium text-white shadow-sm',
                                    'bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-50' => $canSubmit,
                                    'bg-gray-300 cursor-not-allowed' => ! $canSubmit,
                                ])
                            >
                                Confirm order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-slideover wire:model="slider">
        <x-slideover.header>
            <div class="flex space-x-2 text-gray-600 items-center">
                <span>
                    @if ($action === 'add-address')
                        New Address
                    @endif

                    @if ($action === 'add-card')
                        New Card
                    @endif

                    @if ($action === 'add-carrier')
                        New Carrier
                    @endif
                </span>
            </div>
        </x-slideover.header>

        <div class="px-5">
            @if ($action === 'add-address')
                <livewire:account.address-form/>
            @endif

            @if ($action === 'add-card')
                <livewire:account.card-form/>
            @endif

            @if ($action === 'add-carrier')
                <livewire:account.carrier-form/>
            @endif
        </div>
    </x-slideover>
</div>
