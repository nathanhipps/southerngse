<div>
    @if(App\Models\Cart::hasItems())
        <a href="{{ auth()->check() ? route('cart') : route('login') }}">
            <x-heroicon-s-shopping-cart class="w-6 h-6"/>
        </a>
    @endif
</div>
