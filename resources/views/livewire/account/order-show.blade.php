@php use Illuminate\Support\Str; @endphp
<div class="bg-gray-50">
    <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl ">
            <a class="hover:underline text-gray-600" href="{{ route('cart') }}">Account</a>
            <span>/</span>
            <span>Order #{{ $order->number }}</span>
        </h2>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <div>
                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>
                        <div class="text-gray-600">
                            @if ($address = $order->address()->withTrashed()->first())
                                {{ $address->street }}
                                @if ( $address->details)
                                    <br>{{ $address->details }}
                                @endif
                                <br> {{ $address->city }}
                                , {{ $address->state }} {{ $address->zip }}
                            @endif
                        </div>
                    </label>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Credit Card</h2>
                        <div class="text-gray-600">
                            @if ($card = $order->card()->withTrashed()->first())
                                {{ $card->brand }} ending in {{ $card->last_four }} <br>
                                exp: {{ $card->exp_month }}/{{ $card->exp_year }}
                            @endif
                        </div>
                    </label>

                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Freight Carrier</h2>
                        <div class="text-gray-600">
                            @if ($carrier = $order->carrier()->withTrashed()->first())
                                {{ $order->carrier->name }} - {{ $order->carrier->account_number }}
                            @else
                                <span class="block">UPS</span>
                            @endif
                        </div>
                    </label>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                    <label>
                        <h2 class="text-lg font-medium text-gray-900">Delivery Time</h2>
                        <div class="text-gray-600">
                            {{ $order->shipping_time }}
                        </div>
                    </label>
                </div>
            </div>

            <!-- Order summary -->
            @if ($order->closed_at)
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Order summary (Closed
                        on {{ $order->closed_at->toFormattedDateString() }})</h2>

                    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                        <h3 class="sr-only">Items in your cart</h3>
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($order->items as $key => $item)
                                <li class="flex px-4 py-6 sm:px-6">
                                    <div class="flex-shrink-0">
                                        @if ($item->part?->image_path)
                                            <img
                                                src="https://southern-gse.nyc3.digitaloceanspaces.com/{{ $item->part->image_path }}"
                                                alt="{{ $item->part->description }}"
                                                class="w-20 rounded-md"
                                            >
                                        @else
                                            <img
                                                src="https://images.unsplash.com/photo-1610642372651-fe6e7bc209ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300"
                                                alt="{{ $item->part->description }}"
                                                class="w-20 rounded-md"
                                            >
                                        @endif
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
                                                Ordered: {{ $item->quantity }} ({{ $item->shipped_quantity }} Shipped)
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
                                    {{ displayCurrency($order->subtotal) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Estimated Shipping</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ displayCurrency($order->shipping) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Estimated Taxes</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ displayCurrency($order->taxes) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium">Total</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ displayCurrency($order->total) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium">Tracking</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ $order->tracking_number }}
                                </dd>
                            </div>
                        </dl>
                        @if ($order->notes)
                            <div class="px-6 pb-6">
                                <label for="comment"
                                       class="block text-sm font-medium leading-6 text-gray-900">
                                    Notes / Comments
                                </label>
                                <div class="mt-2">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                        <h3 class="sr-only">Items in your cart</h3>
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($order->items as $key => $item)
                                <li class="flex px-4 py-6 sm:px-6">
                                    <div class="flex-shrink-0">
                                        @if ($item->part?->image_path)
                                            <img
                                                src="https://southern-gse.nyc3.digitaloceanspaces.com/{{ $item->part->image_path }}"
                                                alt="{{ $item->part->description }}"
                                                class="w-20 rounded-md"
                                            >
                                        @else
                                            <img
                                                src="https://images.unsplash.com/photo-1610642372651-fe6e7bc209ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300"
                                                alt="{{ $item->part->description }}"
                                                class="w-20 rounded-md"
                                            >
                                        @endif
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
                                    {{ displayCurrency($order->subtotal) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Shipping</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ displayCurrency($order->shipping) }}
                                </dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Taxes</dt>
                                <dd class="text-sm font-medium text-gray-900">Taxes will be calculated during shipment
                                </dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium">Total</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ displayCurrency($order->total) }}
                                </dd>
                            </div>
                        </dl>
                        @if ($order->notes)
                            <div class="px-6 pb-6">
                                <label for="comment"
                                       class="block text-sm font-medium leading-6 text-gray-900">
                                    Notes / Comments
                                </label>
                                <div class="mt-2">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
