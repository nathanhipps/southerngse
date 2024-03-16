@props(['href'])
<a href="{{ $href }}"
   class="-mx-3 block rounded-lg px-3 font-normal py-1.5 leading-7 text-gray-100">
    {{ $slot }}
</a>
