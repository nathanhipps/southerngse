@props([
    'placeholder' => '',
    'name' => '',
    'id' => '',
    'type' => 'text',
    'label' => '',
    'rows' => 4,
    'required' => false
])

<div {{ $attributes->whereStartsWith('class') }}>
    <label
        for="{{ $name }}"
        class="block text-sm font-medium leading-6 text-brand-orange">
        {{ $label }}
        @if ($required)
            <span class="text-brand-orange">*</span>
        @endif
    </label>
    <div class="mt-1">
        <textarea
            {{ $attributes->whereStartsWith('wire:model') }}
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            rows="{{ $rows }}"
            class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="{{ $placeholder }}"
        ></textarea>
    </div>
    @error($name)
    <div class="text-red-800 text-sm flex items-center space-x-1 mt-2 italic">
        <x-icons.exclamation-circle class="w-6"/>
        <span>{{ $message }}</span>
    </div>
    @enderror
</div>
