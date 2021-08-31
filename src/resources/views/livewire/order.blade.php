<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:px-6">
        {{ __('Orders') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <!-- Searcher -->
            <div class="flex md:px-1 py-4">
                <input wire:model="search" class="form-input rounded-md shadow-sm mt-1 block w-1/2" type="text" placeholder="Search..">
                <div class="form-input rounded-md shadow-sm mt-1 block ml-6">
                    <select wire:model="perPage" class="outline-none text-gray-500 text-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                @if ($search !== '')
                    <button wire:click="clear" class="form-input rounded-md shadow-sm mt-1 block ml-6">X</button>
                @endif
            </div>
            {{--
            <!-- Button Create Order -->
            <div class="flex justify-end md:px-1 py-3">
                <x-jet-button wire:click="confirmUserAdd" type="button">{{ __('Create new order') }}</x-jet-button>
            </div>
            --}}

            @if ($orders->count())
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">{{ __('Date') }}</th>
                        <th class="px-4 py-2">{{ __('Warehouse') }}</th>
                        <th class="px-4 py-2">{{ __('Manager') }}</th>
                        <th class="px-4 py-2">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->date }}</td>
                        <td class="border px-4 py-2">{{ $order->warehouse->name }}</td>
                        <td class="border px-4 py-2">{{ $order->manager->name }}</td>
                        <td class="border px-4 py-2">                            
                            <a href="{{ route('order.show', ['order_id' => $order->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                {{ __('View') }}
                            </a>                           
                            <a href="{{ route('order.export', ['order_id' => $order->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                {{ __('Export') }}
                            </a>
                            {{-- 
                            <x-jet-button wire:click="confirmUserEdit({{ $order->id }})" >
                                {{ __('Edit') }}
                            </x-jet-button>
                            <x-jet-secondary-button wire:click="confirmUserDeletion({{ $order->id }})">
                                {{ __('Delete') }}
                            </x-jet-secondary-button>
                            --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="md:px-1 py-3 sm:px-6">
                    {{ __('No results for search') }} "{{ $search }}" {{ __('on page') }} {{ $page }} {{ __('when displaying') }} {{ $perPage }} {{ __('results per page') }}
                </div> 
            @endif
        </div>
        <div class="md:px-1 py-3 sm:px-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>