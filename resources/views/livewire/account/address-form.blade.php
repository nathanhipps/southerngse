<div class="py-10">
    <form wire:submit="save">
        <div class="mb-4">
            <label
                for="name"
                class="block text-sm font-medium leading-6 text-gray-900"
            >
                Location Name
            </label>
            <div class="mt-2">
                <input
                    wire:model="name"
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Atlanta Hangar # 1"
                >
            </div>
            @error('name')
            <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label
                for="street"
                class="block text-sm font-medium leading-6 text-gray-900"
            >
                Address
            </label>
            <div class="mt-2">
                <input
                    wire:model="street"
                    type="text"
                    name="street"
                    id="street"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="123 Jet Landing Ave"
                >
            </div>
            @error('street')
            <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label
                for="details"
                class="block text-sm font-medium leading-6 text-gray-900"
            >
                Address Details
            </label>
            <div class="mt-2">
                <input
                    wire:model="details"
                    type="text"
                    name="details"
                    id="details"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Hangar 101"
                >
            </div>
            @error('details')
            <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-between">
            <div>
                <label
                    for="city"
                    class="block text-sm font-medium leading-6 text-gray-900"
                >
                    City
                </label>
                <div class="mt-2">
                    <input
                        wire:model="city"
                        type="text"
                        name="city"
                        id="city"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Atlanta"
                    >
                </div>
                @error('city')
                <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label
                    for="state"
                    class="block text-sm font-medium leading-6 text-gray-900"
                >
                    State
                </label>
                <div class="mt-2">
                    <input
                        wire:model="state"
                        type="text"
                        name="state"
                        id="state"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Georgia"
                    >
                </div>
                @error('state')
                <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label
                    for="zip"
                    class="block text-sm font-medium leading-6 text-gray-900"
                >
                    Zip/Postal Code
                </label>
                <div class="mt-2">
                    <input
                        wire:model="zip"
                        type="text"
                        name="zip"
                        id="zip"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="30101"
                    >
                </div>
                @error('zip')
                <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <x-button
                type="submit"
            >
                Save
            </x-button>
        </div>
    </form>
</div>
