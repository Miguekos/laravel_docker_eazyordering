<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:px-6">
        {{ __('Products') }}
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
            <div class="flex md:px-1 py-1">
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
            <!-- Button Create Product -->
            <div class="flex justify-end md:px-1 py-3">
                <x-jet-button wire:click="confirmProductImport" type="button">{{ __('Import Products') }}</x-jet-button>
                <x-jet-secondary-button wire:click="confirmProductAdd" type="button">{{ __('Create new product') }}</x-jet-secondary-button>
            </div>
            <!-- Modal Create/Update Product -->
                @include('livewire.product_fields')
            <!-- Modal View Product -->
                @include('livewire.product_view')

            @if ($products->count())
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">{{ __('Code') }}</th>
                        <th class="px-4 py-2">{{ __('Availability') }}</th>
                        @if(Auth::user()->isAdmin())
                        <th class="px-4 py-2">{{ __('Warehouse') }}</th>
                        @endif
                        <th class="px-4 py-2">{{ __('Category') }}</th>
                        <th class="px-4 py-2">{{ __('Family') }}</th>
                        <th class="px-4 py-2">{{ __('Description En') }}</th>
                        <th class="px-4 py-2">{{ __('Price') }}</th>
                        <th class="px-4 py-2">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="border px-4 py-2">{{ $product->code }}</td>
                        <td class="border px-4 py-2">{{ $product->availability == 1 ? 'Available' : 'Unavailable' }}</td>
                        @if(Auth::user()->isAdmin())
                        <td class="border px-4 py-2">{{ $product->warehouse->name }}</td>
                        @endif
                        <td class="border px-4 py-2">{{ ucwords($product->category) }}</td>
                        <td class="border px-4 py-2">{{ ucwords($product->family) }}</td>
                        <td class="border px-4 py-2">{{ $product->description_en }}</td>
                        <td class="border px-4 py-2">{{ $product->total_price }}</td>
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="confirmProductView({{ $product->id }})">
                                {{ __('View') }}
                            </x-jet-button>
                            <x-jet-secondary-button wire:click="confirmProductEdit({{ $product->id }})" >
                                {{ __('Edit') }}
                            </x-jet-secondary-button>
                            <x-jet-secondary-button wire:click="confirmProductDeletion({{ $product->id }})">
                                {{ __('Delete') }}
                            </x-jet-secondary-button>
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
            {{ $products->links() }}
        </div>
    </div>
</div>