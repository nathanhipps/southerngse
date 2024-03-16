<div>
    <div class="bg-white rounded-xl px-6 py-5">
        <form wire:submit="submit" class="space-y-6">
            <input wire:model="hp" type="hidden" name="fullname">
            <input
                wire:model="ts"
                type="hidden"
                name="time"
            >
            <x-form.input
                wire:model="name"
                placeholder="Full Name"
                name="name"
                id="name"
                label="Full Name"
                required
            />

            <x-form.input
                wire:model="email"
                placeholder="Email Address"
                name="email"
                id="email"
                label="Email Address"
                type="email"
                required
            />

            <x-form.input
                wire:model="subject"
                placeholder="Make & Model"
                name="subject"
                id="subject"
                label="Equipment Type"
                required
            />

            <x-form.textarea
                wire:model="message"
                placeholder="How can we help you?"
                name="message"
                id="message"
                label="{{ $messageLabel ?? 'Repairs Needed' }}"
                required
            />
            <x-form.button>
                Send
            </x-form.button>
        </form>
    </div>
</div>
