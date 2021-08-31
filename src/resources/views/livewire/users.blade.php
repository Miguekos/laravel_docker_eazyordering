<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:px-6">
        {{ __('Users') }}
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
            <!-- Button Create User -->
            <div class="flex justify-end md:px-1 py-3">
                <x-jet-button wire:click="confirmUserAdd" type="button">{{ __('Create new user') }}</x-jet-button>
            </div>
            <!-- Modal Create/Update User -->
                @include('livewire.user_fields')

            @if ($users->count())
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">{{ __('Name') }}</th>
                        <th class="px-4 py-2">{{ __('Email') }}</th>
                        <th class="px-4 py-2">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="confirmUserEdit({{ $user->id }})" >
                                {{ __('Edit') }}
                            </x-jet-button>
                            <x-jet-secondary-button wire:click="confirmUserDeletion({{ $user->id }})">
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
            {{ $users->links() }}
        </div>
    </div>
</div>