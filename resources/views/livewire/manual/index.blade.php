<div>

    <div class="max-w-6xl mx-auto">
        <div class="px-4 sm:px-6 lg:px-8 pt-12">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-semibold leading-6 text-gray-900">Equipment Manuals</h1>
                </div>
            </div>
            <div class="sm:flex items-center sm:space-x-4 pt-8">
                <x-input
                    wire:model.live.debounce="search"
                    placeholder="Search for manuals..."
                    class="sm:w-96 w-full"
                />
                <x-button wire:click="clearSearch" class="w-full mt-4 sm:mt-0 sm:w-36">Clear Search</x-button>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Description
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($manuals as $manual)
                                <tr>
                                    <td class="py-5 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $manual->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-5 text-sm text-gray-500">
                                        <div class="text-gray-900">{!! $manual->description !!}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                        <a
                                            href="{{ env('DO_BASE_URL') . '/' . $manual->file_path }}"
                                            type="button"
                                            class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            Download
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pb-12 mt-6">
                            {{ $manuals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
