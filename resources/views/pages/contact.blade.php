<x-layouts.marketing>
    <div class=" relative">
        <img src="/images/contact-cta-bg.png" class="object-cover w-full h-[1000px] md:h-[1200px] lg:h-[800px]"
             alt="Southern GSE ground support equipment background">
        <div class="w-full h-[1000px] md:h-[1200px] lg:h-[800px] bg-brand-blue opacity-60 absolute inset-0"></div>
        <div
            class="max-w-xl w-full h-[1000px] md:h-[1200px] lg:h-[800px] absolute inset-0 lg:flex-row lg:items-center lg:max-w-full flex flex-col justify-center px-8 lg:px-20 text-gray-100 shadow">
            <div class="lg:w-1/2 lg:pr-6">
                <h1 class="heading-1 text-gray-200 max-w-sm lg:max-w-2xl">Let's Keep in Touch</h1>
                <p class="lg:max-w-2xl mt-4 text-gray-400 shadow subheader-lg mb-6">
                    You can call, email, or fill out this form to contact Southern GSE about your service needs.
                    Someone will reach out with a response within 1 business day.
                </p>
                <div class="mb-6">
                    <a href="tel:4046207175" class="flex space-x-4">
                        <x-icons.phone class="w-6"/>
                        <p class="subheader-lg opacity-75">(404) 620 - 7175</p>
                    </a>
                </div>
                <div>
                    <a href="mailto:info@southerngse.com" class="flex space-x-4">
                        <x-icons.envelope class="w-6"/>
                        <p class="subheader-lg opacity-75">info@southerngse.com
                        </p>
                    </a>
                </div>
            </div>
            <div class="pt-10 lg:w-1/2">
                <livewire:service-form messageLabel="How can we help"/>
            </div>
        </div>
    </div>
</x-layouts.marketing>
