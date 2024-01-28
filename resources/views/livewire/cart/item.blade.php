<li :key="$item->id" class="flex py-6 sm:py-10">
    <div class="flex-shrink-0">
        @if ($item->part?->image_path)
            <img
                src="https://southern-gse.nyc3.digitaloceanspaces.com/{{ $item->part->image_path }}"
                alt="{{ $item->part->description }}"
                class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48">
        @else
            <img
                src="https://images.unsplash.com/photo-1610642372651-fe6e7bc209ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300"
                alt="{{ $item->part->description }}"
                class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48">
        @endif
    </div>

    <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
            <div>
                <div class="flex justify-between">
                    <h3 class="text-sm">
                        <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                            {{ $item->part->sku }}
                        </a>
                    </h3>
                </div>
                <div class="mt-1 flex text-sm">
                    <p class="text-gray-500">
                        {{ $item->part->description }}
                    </p>
                </div>
                <p class="mt-1 text-sm font-medium text-gray-900">
                    {{ $item->part->display_price }}
                </p>
            </div>

            <div class="mt-4 sm:mt-0 sm:pr-9">
                <label for="quantity-{{ $item->id }}"
                       class="sr-only">{{ $item->part->description }}</label>

                <select
                    wire:model.live="quantity"
                    id="quantity-{{ $item->id }}"
                    name="quantity-{{ $item->id }}"
                    class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                >
                    @foreach(range(1, 100) as $number)
                        <option value="{{ $number }}">{{ $number }}</option>
                    @endforeach
                </select>

                <div class="absolute right-0 top-0">
                    <button
                        wire:click="remove"
                        type="button"
                        class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Remove</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path
                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        @if ($item->part->inventory > $item->quantity)
            <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                          clip-rule="evenodd"/>
                </svg>
                <span>In stock</span>
            </p>
        @else
            <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                <svg class="h-5 w-5 flex-shrink-0 text-gray-300" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                          clip-rule="evenodd"/>
                </svg>
                <span>Ships in {{ $item->part->lead_time_in_days }} days</span>
            </p>
        @endif
    </div>
</li>
