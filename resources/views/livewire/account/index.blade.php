<div class="max-w-5xl mx-auto px-5 my-8">
    <div class="border-gray-200 border-2  rounded-xl shadow px-10 py-10">
        <div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select
                    wire:model="page"
                    id="tabs"
                    name="tabs"
                    class="block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                >
                    <option value="account">My Account</option>
                    <option value="orders">Orders</option>
                    <option value="addresses">Addresses</option>
                    <option value="cards">Credit Cards</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <!-- Current: "border-green-500 text-green-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                        <button wire:click="changePage('account')" type="button"
                                @class([
                                     'group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium',
                                     'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => $page !== 'account',
                                     'border-green-500 text-green-600' => $page === 'account',
                                 ])
                                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium">
                            <!-- Current: "text-green-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                            <x-icons.user
                                @class([
                                    '-ml-0.5 mr-2 h-5 w-5',
                                    'text-gray-400 group-hover:text-gray-500' => $page !== 'account',
                                    'border-green-500 text-green-600' => $page === 'account',
                                ])/>
                            <span>My Account</span>
                        </button>
                        <button wire:click="changePage('orders')" type="button"
                                @class([
                                     'group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium',
                                     'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => $page !== 'orders',
                                     'border-green-500 text-green-600' => $page === 'orders',
                                 ])
                                aria-current="page">
                            <x-icons.package
                                @class([
                                    '-ml-0.5 mr-2 h-5 w-5',
                                    'text-gray-400 group-hover:text-gray-500' => $page !== 'orders',
                                    'border-green-500 text-green-600' => $page === 'orders',
                                ])/>
                            <span>Orders</span>
                        </button>
                        <button wire:click="changePage('addresses')" type="button"
                            @class([
                                 'group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium',
                                 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => $page !== 'addresses',
                                 'border-green-500 text-green-600' => $page === 'addresses',
                             ])>
                            <x-icons.buildings
                                @class([
                                   '-ml-0.5 mr-2 h-5 w-5',
                                   'text-gray-400 group-hover:text-gray-500' => $page !== 'addresses',
                                   'border-green-500 text-green-600' => $page === 'addresses',
                               ])/>
                            <span>Addresses</span>
                        </button>
                        <button wire:click="changePage('cards')" type="button"
                            @class([
                                 'group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium',
                                 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => $page !== 'cards',
                                 'border-green-500 text-green-600' => $page === 'cards',
                             ])>
                            <x-icons.credit-card
                                @class([
                                       '-ml-0.5 mr-2 h-5 w-5',
                                       'text-gray-400 group-hover:text-gray-500' => $page !== 'cards',
                                       'border-green-500 text-green-600' => $page === 'cards',
                                   ])/>
                            <span>Credit Cards</span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        <div>
            @if ($page === 'account')
                <livewire:account.account/>
            @endif

            @if ($page === 'orders')
                <livewire:account.orders/>
            @endif

            @if ($page === 'addresses')
                <livewire:account.addresses/>
            @endif

            @if ($page === 'cards')
                <livewire:account.cards/>
            @endif
        </div>
    </div>
</div>
