<div>
    <div class="max-w-6xl mx-auto">
        <div class="px-4 sm:px-6 lg:px-8 pt-12">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-semibold leading-6 text-gray-900">Used/Reconditioned Equipment</h1>
                    <p class="mt-6 text-sm text-gray-700 max-w-xl">
                        Below is a list of available equipment in both used and reconditioned condition. Please request
                        more information by clicking on the link and filling out the form.
                    </p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Model
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Description
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Quantity
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($equipment as $unit)
                                <tr>
                                    <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex items-center">
                                            <div class="h-20 w-20 flex-shrink-0">
                                                @if ($unit->image_path)
                                                    <img
                                                        src="https://southern-gse.nyc3.digitaloceanspaces.com/{{ $unit->image_path }}"
                                                        alt="{{ $unit->model }}"
                                                        class="h-20 w-20 rounded-full">
                                                @else
                                                    <img
                                                        src="https://images.unsplash.com/photo-1610642372651-fe6e7bc209ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300"
                                                        alt="{{ $unit->model }}"
                                                        class="h-20 w-20 rounded-full">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $unit->model_number }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-5 text-sm text-gray-500">
                                        <div class="text-gray-900">{{ $unit->description }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500 text-center">
                                <span
                                    class="inline-flex items-center rounded-full bg-green-50 px-4 py-2 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                    {{ $unit->quantity }}
                                </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                        <a
                                            wire:click="setSubject('{{ $unit->model_number }}')"
                                            href="#form"
                                            type="button"
                                            class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            Request Info
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pb-12 mt-6">
                            {{ $equipment->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="form" class="bg-gray-100 py-20">
        <h2 class="text-center text-gray-700 text-xl font-bold mb-6">Request more information</h2>
        <div class="max-w-xl mx-auto">
            <livewire:service-form messageLabel="Message"/>
        </div>
    </div>
</div>
