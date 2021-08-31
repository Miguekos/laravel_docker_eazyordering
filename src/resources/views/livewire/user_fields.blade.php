<!-- Create / Update -->
<x-jet-dialog-modal wire:model="isOpen">
  <x-slot name="title">
      {{ empty($this->user->id) ? __('Add User') : __('Edit User') }}
  </x-slot>

  <x-slot name="content">
    <!-- Role -->
    <div class="mt-4 mr-2 mb-4">
        <x-jet-label for="select-role" value="{{ __('Role') }}" class="mb-1" />
            <select
                wire:model="role_id"
                id="select-category" 
                style="width: 100%"
                data-placeholder="{{ __('Select a role') }}"
                data-allow-clear="false"
                title="{{ __('Select a role') }}">
                <option value="" selected>{{ __('Select a role') }}</option>
                @foreach ($roles as $roleKey => $rolevalue)
                    <option value="{{ $roleKey }}">{{ ucwords($rolevalue) }}</option>
                @endforeach
            </select>
        <x-jet-input-error for="role_id" class="mt-2" />
    </div>

    <!-- Name -->
    <div class="mb-4">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" type="text" wire:model="name" class="mt-1 block w-full" placeholder="Enter Name"/>
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mb-4">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" type="text" wire:model="email" class="mt-1 block w-full" placeholder="Enter Email"/>
        <x-jet-input-error for="email" class="mt-2" />
    </div>
  </x-slot>

  <x-slot name="footer">
      <x-jet-secondary-button wire:click="resetModel" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
          {{ __('Save') }}
      </x-jet-button>
  </x-slot>
</x-jet-dialog-modal>

<!-- Delete -->
<x-jet-dialog-modal wire:model="confirmingUserDeletion">
  <x-slot name="title">
      {{ __('Delete User') }}
  </x-slot>

  <x-slot name="content">
      {{ __('Are you sure you want to delete user account?') }}
  </x-slot>

  <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-danger-button class="ml-2" wire:click="delete({{ $confirmingUserDeletion }})" wire:loading.attr="disabled">
          {{ __('Delete Account') }}
      </x-jet-danger-button>
  </x-slot>
</x-jet-dialog-modal>