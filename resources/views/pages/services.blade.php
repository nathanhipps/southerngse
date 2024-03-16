<x-layouts.marketing>
    <div class="min-h-[375px] relative">
        <img src="/images/hero-2.jpg" class="object-cover w-full h-[375px] lg:h-[400px]"
             alt="Southern GSE ground support equipment background">
        <div class="w-full h-[375px] lg:h-[400px] bg-brand-blue opacity-60 absolute inset-0"></div>
        <div
            class="max-w-xl sm:max-w-3xl w-full h-[375px] lg:h-[400px] absolute inset-0 flex flex-col justify-center px-8 lg:px-20 text-gray-100 shadow">
            <h1 class="heading-1 max-w-sm lg:max-w-2xl">Southern GSE Service</h1>
            <p class="mt-4 text-gray-200 shadow subheader-lg">
                With our experienced team of technicians and support staff, Southern GSE stands ready to keep your
                ground operations running.
            </p>
        </div>
    </div>

    <div class="bg-brand-orange text-white text-center py-12 sm:flex">
        <div class="mb-10 sm:mb-0 sm:w-1/2">
            <h2 class="heading-3 sm:text-[24px] mb-2 opacity-90">Service Department:</h2>
            <p class="heading-3 sm:leading-4 sm:text-[24px] opacity-75"><a href="tel:4046207175">(404) 620 - 7175</a>
            </p>
        </div>
        <div class="sm:w-1/2">
            <h2 class="heading-3 sm:text-[24px] mb-2 opacity-90">Service Email:</h2>
            <p class="heading-3 sm:leading-4 sm:text-[24px] opacity-75"><a href="mailto:service@southerngse.com">service@southerngse.com</a>
            </p>
        </div>
    </div>

    <div class="px-8 py-12">
        <div class="sm:flex sm:space-x-12 items-center">
            <div class="sm:flex-1">
                <h3 class="heading-2 max-w-xs lg:max-w-xl mb-6">
                    Keep your ground operations running strong
                </h3>
                <p class="body-lg text-gray-600 mb-12">
                    With decades of experience in the industry, Southern GSE is here to help you with all your Ground
                    Support
                    needs.
                </p>
            </div>
            <img class="rounded-2xl mb-16 sm:max-w-1/2" src="/images/service.jpg"
                 alt="Hobart and ITW GSE ground support and ground power equipment repair services">
        </div>
        <div class="lg:flex justify-between lg:space-x-20 lg:mt-12">
            <div class="mb-16">
                <h4 class="body-lg text-brand-orange text-center mb-4">Preventive Maintenance</h4>
                <p class="body text-center">
                    Southern GSE offers top-quality preventive maintenance on GSE equipment. We proactively identify
                    and address any maintenance or wear issues before they can appear on the runway.
                </p>
            </div>
            <div class="mb-16">
                <h4 class="body-lg text-brand-orange text-center mb-4">Breakdown Repairs</h4>
                <p class="body text-center">
                    Our dedicated GSE experts are here for you when unexpected repairs are needed. We offer both
                    remote and on-site repair services, ensuring your machine is back in working order with minimal
                    down-time.
                </p>
            </div>
            <div class="mb-16">
                <h4 class="body-lg text-brand-orange text-center mb-4">Remote Diagnostics</h4>
                <p class="body text-center">
                    We take pride in our modern approach to diagnostics. If you have the skill and tools to perform your
                    own
                    repairs,
                    we can remotely talk you through the repair process and troubleshoot on-the-fly.
                </p>
            </div>
        </div>
    </div>

    <div class=" relative">
        <img src="/images/contact-cta-bg.png" class="object-cover w-full h-[1000px] md:h-[1200px] lg:h-[800px]"
             alt="Southern GSE ground support equipment background">
        <div class="w-full h-[1000px] md:h-[1200px] lg:h-[800px] bg-brand-blue opacity-60 absolute inset-0"></div>
        <div
            class="max-w-xl w-full h-[1000px] md:h-[1200px] lg:h-[800px] absolute inset-0 lg:flex-row lg:items-center lg:max-w-full flex flex-col justify-center px-8 lg:px-20 text-gray-100 shadow">
            <div class="lg:w-1/2 lg:pr-6">
                <h1 class="heading-1 text-gray-200 max-w-sm lg:max-w-2xl">Request Service</h1>
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
                    <a href="mailto:service@southerngse.com" class="flex space-x-4">
                        <x-icons.envelope class="w-6"/>
                        <p class="subheader-lg opacity-75">service@southerngse.com
                        </p>
                    </a>
                </div>
            </div>
            <div class="pt-10 lg:w-1/2">
                <livewire:service-form/>
            </div>
        </div>
    </div>
</x-layouts.marketing>
