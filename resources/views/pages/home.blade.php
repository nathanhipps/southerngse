<x-layouts.marketing>
    <div class="min-h-[375px] relative">
        <img src="/images/hero.jpg" class="object-cover w-full h-[375px] lg:h-[400px]"
             alt="Southern GSE ground support equipment background">
        <div class="w-full h-[375px] lg:h-[400px] bg-brand-blue opacity-60 absolute inset-0"></div>
        <div
            class="max-w-2xl w-full h-[375px] lg:h-[400px] absolute inset-0 flex flex-col justify-center px-8 lg:px-20 text-gray-100 shadow">
            <h1 class="heading-1 lg:max-w-2xl">Your Trusted GSE Specialists</h1>
            <p class="lg:max-w-2xl mt-4 text-gray-200 shadow subheader-lg">
                We specialize in providing top-notch parts and service for all types of ground support
                equipment and we are an authorized ITWGSE (Hobart) service provider
            </p>
        </div>
    </div>


    <div class="py-8 px-5 lg:px-20 mb-12">
        <div class="sm:flex space-x-12 items-center lg:space-x-20 sm:mb-12">
            <div class="sm:flex-1 max-w-xl">
                <h2 class="heading-2">Your one-stop-shop for all things GSE</h2>
                <p class="mt-4 subheader-lg">
                    With decades of experience in the industry, Southern GSE is here to help you with all your Ground
                    Support needs.
                </p>
            </div>
            <div class="sm:w-1/3 lg:max-w-full lg:w-5/12">
                <img src="/images/gpus.png" alt="A full line of hobart ground power itw gse ground power units">
            </div>
        </div>
        <div class="mt-4 space-y-20 lg:space-y-0 lg:flex lg:space-x-20">
            <div class="lg:flex flex-col justify-between">
                <h3 class="subheader-lg text-brand-orange text-center mb-4">Online Parts Store</h3>
                <p class="body text-center mb-6 text-gray-700">
                    Genuine GPU replacement parts are just a click away with Southern GSE’s online parts store.
                </p>
                <div class="sm:flex justify-center">
                    <a href="{{ route('parts') }}"
                       class="sm:max-w-64 bg-brand-orange text-white w-full py-4 block rounded-lg text-center shadow subheader-lg">
                        Shop Parts
                    </a>
                </div>
            </div>
            <div class="lg:flex flex-col justify-between">
                <h3 class="subheader-lg text-brand-orange text-center mb-4">GSE Manuals</h3>
                <p class="body text-center mb-6 text-gray-700">
                    Stay up to date on your equipment by downloading manuals, parts lists, and drawings.
                </p>
                <div class="sm:flex justify-center">
                    <a href="{{ route('manuals') }}"
                       class="sm:max-w-64 bg-brand-orange text-white w-full py-4 block rounded-lg text-center shadow subheader-lg">
                        Downloads
                    </a>
                </div>
            </div>
            <div class="lg:flex flex-col justify-between">
                <h3 class="subheader-lg text-brand-orange text-center mb-4">GSE Equipment</h3>
                <p class="body text-center mb-6 text-gray-700">
                    Check out Southern GSE’s incredible deals on new and used aviation ground power equipment.
                </p>
                <div class="sm:flex justify-center">
                    <a href="{{ route('equipment-used') }}"
                       class="sm:max-w-64 bg-brand-orange text-white w-full py-4 block rounded-lg text-center shadow subheader-lg">
                        Equipment
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="min-h-[560px] relative sm:mx-8 sm:rounded-3xl overflow-hidden">
        <img src="/images/hero-2-zoom.jpg"
             class="w-full lg:hidden object-cover h-[560px] sm:rounded-3xl"
             alt="Southern GSE ground support equipment background">
        <img src="/images/hero-2.jpg"
             class="hidden lg:block w-full object-cover h-[560px] sm:rounded-3xl"
             alt="Southern GSE ground support equipment background">
        <div class="w-full h-[560px] bg-gray-900 opacity-60 absolute inset-0 rounded-3xl"></div>
        <div
            class="w-full h-[560px] absolute inset-0 flex flex-col lg:flex-row lg:space-x-20 lg:items-center justify-center px-8 lg:px-20 text-gray-100 shadow">
            <div class="flex items-center justify-center mb-12">
                <x-logos.secondary-inverse class="w-60 lg:w-96"/>
            </div>
            <div class="max-w-md">
                <h3 class="heading-2 lg:max-w-2xl mb-2">Stay Flight-Ready with Southern GSE</h3>
                <p class="lg:max-w-2xl mt-4 text-gray-200 shadow text-[16px] leading-[22.4px] roboto-medium mb-6">
                    Southern GSE offers repair and maintenance services for most of your ground support equipment. If
                    you are in need of a complete overhaul or just general maintenance, give us a call.
                </p>
                <a href="{{ route('contact') }}"
                   class="sm:max-w-64 bg-gray-100 text-brand-orange w-full py-4 block rounded-lg text-center shadow subheader-lg">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <div class="px-6 container mx-auto">
        <div class="pt-20">
            <h2 class="heading-2 text-center mb-4 lg:max-w-lg lg:mx-auto">Everything you need at Southern GSE</h2>
            <p class="text-center text-[18px] leading-[28.8px] roboto-regular mb-12">
                Southern GSE is your one-stop-shop for ground power equipment, service and parts.
            </p>
        </div>
        <div class="relative lg:grid grid-cols-5">
            <img class="sm:hidden absolute -bottom-16 -right-6 z-0" src="/images/about-bg-mobile.png"
                 alt="Southern GSE Equipment is your partner for ground support equipment services">

            <div class="lg:w-64">
                <h4 class="subheader-lg text-brand-orange mb-4">Service</h4>
                <p class="body mb-6">
                    Keep equipment running strong with Southern GSE’s quality service.
                </p>
            </div>

            <div></div>

            <img
                class="lg:row-span-2 hidden sm:block absolute lg:relative lg:bottom-0 self-end -bottom-16 right-0 z-0"
                src="/images/about-bg-tablet.jpg"
                alt="Southern GSE Equipment is your partner for ground support equipment services">

            <div></div>

            <div class="lg:w-64">
                <h4 class="subheader-lg text-brand-orange mb-4">Equipment</h4>
                <p class="body mb-6 max-w-52">
                    Keep equipment running strong with Southern GSE’s quality service.
                </p>
            </div>

            <div class="lg:w-64">
                <h4 class="subheader-lg text-brand-orange mb-4">Parts</h4>
                <p class="body mb-6 max-w-52">
                    Keep equipment running strong with Southern GSE’s quality service.
                </p>
            </div>
            <div></div>
            <div></div>
            <div class="lg:w-64">
                <h4 class="subheader-lg text-brand-orange mb-4">Manuals</h4>
                <p class="body max-w-52 mb-16">
                    Keep equipment running strong with Southern GSE’s quality service.
                </p>
            </div>
        </div>
    </div>
</x-layouts.marketing>
