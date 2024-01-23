<div class="py-10">
    <form wire:submit="save">
        <div class="mb-4">
            <label
                for="name"
                class="block text-sm font-medium leading-6 text-gray-900"
            >
                Carrier Name
            </label>
            <div class="mt-2">
                <input
                    wire:model="name"
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="UPS"
                >
            </div>
            @error('name')
            <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label
                for="account-number"
                class="block text-sm font-medium leading-6 text-gray-900"
            >
                Account Number
            </label>
            <div class="mt-2">
                <input
                    wire:model="account_number"
                    type="text"
                    name="account-number"
                    id="account-number"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="1Z111222333444555"
                >
            </div>
            @error('street')
            <span class="text-xs text-red-700 block pt-1 italic">{{ $message }}</span>
            @enderror
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
