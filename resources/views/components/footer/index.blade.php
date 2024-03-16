<!-- Footer -->
<footer class="bg-brand-blue" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="lg:flex mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8 lg:py-20">
        <div class="flex items-center justify-center lg:pr-20">
            <a href="{{ route('home') }}">
                <x-logos.orange class="w-32"/>
            </a>
        </div>
        <div class="lg:grid md:grid-cols-3 lf:gap-4 flex-1">
            <div>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('services') }}"
                           class="text-base leading-6 text-gray-100 hover:text-white">
                            Services
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('parts') }}"
                           class="text-base leading-6 text-gray-100 hover:text-white">Parts</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('equipment-used') }}"
                           class="text-base leading-6 text-gray-100 hover:text-white">
                            Used Equipment
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('manuals') }}" class="text-base leading-6 text-gray-100 hover:text-white">Manuals</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('contact') }}"
                           class="text-base leading-6 text-gray-100 hover:text-white">Contact</a>
                    </li>
                </ul>
            </div>
            @if (auth()->user())
                <div>
                    <ul role="list" class="mt-4 space-y-4">
                        <li>
                            <a href="{{ route('account') }}"
                               class="text-base leading-6 text-gray-100 hover:text-white">Your
                                Account</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="mx-auto max-w-7xl">
        <div class="bg-gray-400 opacity-75 h-[2px] my-6"></div>
        <div class="text-gray-300 pb-12">
            &copy; {{ now()->format('Y') }} Southern GSE All rights reserved.
        </div>
    </div>
</footer>
