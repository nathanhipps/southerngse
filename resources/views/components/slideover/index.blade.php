<div
    x-data="{
        show: false,
    }"
    x-modelable="show"
    x-on:keydown.esc.window="show = false; $dispatch('unlock-scroll')"
    {{ $attributes }}
>
    <div x-show="show" x-cloak class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div
                    x-show="show"
                    x-cloak
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16"
                >
                    <div x-on:click.away="show = false; $dispatch('unlock-scroll')"
                         class="pointer-events-auto w-screen max-w-2xl">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
