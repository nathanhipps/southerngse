<div class="bg-gray-50 px-4 py-6 sm:px-6">
    <div class="flex items-start justify-between space-x-3">
        <div class="space-y-1">
            {{ $slot }}
        </div>
        <div class="flex h-7 items-center">
            <button x-on:click="show = false; $dispatch('unlock-scroll')" type="button"
                    class="relative text-gray-400 hover:text-gray-500">
                <span class="absolute -inset-2.5"></span>
                <span class="sr-only">Close panel</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
