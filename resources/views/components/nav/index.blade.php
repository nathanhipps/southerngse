<header
    x-data="{
        show: false
    }"
    class="absolute inset-x-0 top-0 z-50 bg-brand-blue"
>
    <nav
        class="flex sm:flex-row-reverse lg:flex-row items-center sm:justify-end justify-between px-6 py-4 lg:px-8"
        aria-label="Global"
    >
        <div class="flex sm:pl-6">
            <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">Southern GSE</span>
                <x-logos.orange class="w-10"/>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button
                x-on:click="show = true"
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400"
            >
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>

        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <div class="flex items-center space-x-8">
                <x-nav.desktop-link href="{{ route('services') }}">Services</x-nav.desktop-link>
                <x-nav.desktop-link href="{{ route('parts') }}">Parts</x-nav.desktop-link>
                <x-nav.desktop-link href="{{ route('manuals') }}">Manuals</x-nav.desktop-link>
                <x-nav.desktop-link href="{{ route('equipment-used') }}">Used Equipment</x-nav.desktop-link>
                <x-nav.desktop-link href="{{ route('contact') }}">Contact</x-nav.desktop-link>
                <span class="text-white">
                    <livewire:cart.counter/>
                </span>
                @if (auth()->user()?->is_admin)
                    <a href="/admin" class="text-sm font-semibold leading-6 text-white">
                        Admin
                    </a>
                @endif
                @if (auth()->check())
                    <a href="{{ route('account') }}" class="text-sm font-semibold leading-6 text-white">
                        Your&nbspaccount&nbsp<span aria-hidden="true">&rarr;</span>
                    </a>
                @else
                    <a href="/login" class="text-sm font-semibold leading-6 text-white">
                        Log in <span aria-hidden="true">&rarr;</span>
                    </a>
                @endif
            </div>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div
        class="lg:hidden"
        role="dialog"
        aria-modal="true"
        x-show="show"
        x-cloak
    >
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-50"></div>
        <div
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-brand-blue px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-center">
                <a href="/" class="-m-1.5 p-1.5">
                    <x-logos.orange class="w-32"/>
                </a>
                <div class="absolute top-6 right-6">
                    <button
                        x-on:click="show = false"
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-gray-300"
                    >
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6 text-gray-100 font-bold">
                        <x-nav.mobile-link href="#">New Equipment</x-nav.mobile-link>
                        <x-nav.mobile-link href="{{ route('equipment-used') }}">Used Equipment</x-nav.mobile-link>
                        <x-nav.mobile-link href="{{ route('parts') }}">Parts</x-nav.mobile-link>
                        <x-nav.mobile-link href="{{ route('manuals') }}">Manuals</x-nav.mobile-link>
                        <x-nav.mobile-link href="{{ route('services') }}">Services</x-nav.mobile-link>
                        <x-nav.mobile-link href="{{ route('contact') }}">Contact</x-nav.mobile-link>
                        <div class="pt-2">
                            <livewire:cart.counter/>
                        </div>
                    </div>
                    <div class="py-6">
                        @if (auth()->user()?->is_admin)
                            <a href="/admin"
                               class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">
                                Admin
                            </a>
                        @endif
                        @if (auth()->check())
                            <a href="{{ route('account') }}"
                               class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">
                                Your Account
                            </a>
                        @else
                            <a href="/login"
                               class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">
                                Log in
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
