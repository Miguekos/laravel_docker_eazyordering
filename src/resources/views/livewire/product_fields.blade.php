<!-- Create / Update -->
<x-jet-dialog-modal wire:model="isOpen">
  <x-slot name="title">
      {{ empty($this->product->id) ? __('Add Product') : __('Edit Product') }}
  </x-slot>

  <x-slot name="content">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Code -->
        <div class="mt-3 mr-2">
            <x-jet-label for="code" value="{{ __('Code') }}" />
            <x-jet-input id="code" type="text" wire:model="code" class="mt-1 block w-full" placeholder="Code"/>
            <x-jet-input-error for="code" class="mt-2" />
        </div>
        <!-- Warehouse -->
        <div class="mt-4 ml-2">
            <x-jet-label for="select-warehouse" value="{{ __('Warehouse') }}" class="mb-1" />
                <select
                    wire:model="warehouse_id"
                    id="select-warehouse" 
                    style="width: 100%"
                    data-placeholder="{{ __('Select a warehouse') }}"
                    data-allow-clear="false"
                    title="{{ __('Select a warehouse') }}">
                    <option value="" selected>{{ __('Select a warehouse') }}</option>
                    @foreach ($warehouses as $warehouseKey => $warehousevalue)
                        <option value="{{ $warehouseKey }}">{{ $warehousevalue }}</option>
                    @endforeach
                </select>
            <x-jet-input-error for="warehouse_id" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Category -->
        <div class="mt-4 mr-2">
            <x-jet-label for="select-category" value="{{ __('Category') }}" class="mb-1" />
                <select
                    wire:model="category"
                    id="select-category" 
                    style="width: 100%"
                    data-placeholder="{{ __('Select a category') }}"
                    data-allow-clear="false"
                    title="{{ __('Select a category') }}">
                    <option value="" selected>{{ __('Select a category') }}</option>
                    @foreach ($categoriesOptions as $categoryKey => $categoryvalue)
                        <option value="{{ $categoryKey }}">{{ $categoryvalue }}</option>
                    @endforeach
                </select>
            <x-jet-input-error for="category" class="mt-2" />
        </div>
        <!-- Family -->
        <div class="mt-4 ml-2">
            <x-jet-label for="select-family" value="{{ __('Family') }}" class="mb-1" />
                <select
                    wire:model="family"
                    id="select-family" 
                    style="width: 100%"
                    data-placeholder="{{ __('Select a family') }}"
                    data-allow-clear="false"
                    title="{{ __('Select a family') }}">
                    <option value="" selected>{{ __('Select a family') }}</option>
                    @foreach ($familyOptions as $familyKey => $familyvalue)
                        <option value="{{ $familyKey }}">{{ $familyvalue }}</option>
                    @endforeach
                </select>
            <x-jet-input-error for="family" class="mt-2" />
        </div>
    </div>

    <!-- Description EN-->
    <div class="mt-4">
        <x-jet-label for="description_en" value="{{ __('Description En') }}" />
        <x-jet-input id="description_en" type="text" wire:model="description_en" class="mt-1 block w-full" placeholder="Description En"/>
        <x-jet-input-error for="description_en" class="mt-2" />
    </div>
    <!-- Description ES-->
    <div class="mt-4">
        <x-jet-label for="description_es" value="{{ __('Description Es') }}" />
        <x-jet-input id="description_es" type="text" wire:model="description_es" class="mt-1 block w-full" placeholder="Description Es"/>
        <x-jet-input-error for="description_es" class="mt-2" />
    </div>
    <!-- Description IT-->
    <div class="mt-4">
        <x-jet-label for="description_it" value="{{ __('Description It') }}" />
        <x-jet-input id="description_it" type="text" wire:model="description_it" class="mt-1 block w-full" placeholder="Description It"/>
        <x-jet-input-error for="description_it" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Unit Weight -->
        <div class="mt-3 mr-2">
            <x-jet-label for="unit_weight" value="{{ __('Unit Weight') }}" />
            <x-jet-input id="unit_weight" type="text" wire:model="unit_weight" class="mt-1 block w-full" placeholder="Unit Weight"/>
            <x-jet-input-error for="unit_weight" class="mt-2" />
        </div>
        <!-- Unit of Measurement -->
        <div class="mt-4 ml-2">
          <x-jet-label for="select-uom" value="{{ __('Unit of Measurement') }}" class="mb-1" />
              <select
                  wire:model="uom"
                  id="select-uom" 
                  style="width: 100%"
                  data-placeholder="{{ __('Select Unit of Measurement') }}"
                  data-allow-clear="false"
                  title="{{ __('Select Unit of Measurement') }}">
                  <option value="" selected>{{ __('Select Unit of Measurement') }}</option>
                  @foreach ($uomOptions as $uomKey => $uomValue)
                      <option value="{{ $uomKey }}">{{ $uomValue }}</option>
                  @endforeach
              </select>
          <x-jet-input-error for="uom" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Pieces -->
        <div class="mt-3 mr-2">
            <x-jet-label for="pieces" value="{{ __('Pieces') }}" />
            <x-jet-input id="pieces" type="text" wire:model="pieces" class="mt-1 block w-full" placeholder="Pieces"/>
            <x-jet-input-error for="pieces" class="mt-2" />
        </div>
        <!-- Pack Description-->
        <div class="mt-4 ml-2">
          <x-jet-label for="select-pack" value="{{ __('Pack Description') }}" class="mb-1" />
              <select
                  wire:model="pack_description"
                  id="select-pack" 
                  style="width: 100%"
                  data-placeholder="{{ __('Select a pack description') }}"
                  data-allow-clear="false"
                  title="{{ __('Select a pack description') }}">
                  <option value="" selected>{{ __('Select a pack description') }}</option>
                  @foreach ($packOptions as $packKey => $packvalue)
                      <option value="{{ $packKey }}">{{ $packvalue }}</option>
                  @endforeach
              </select>
          <x-jet-input-error for="pack_description" class="mt-2" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Stock -->
        <div class="mt-4 mr-2">
            <x-jet-label for="stock" value="{{ __('Stock') }}" />
            <x-jet-input id="stock" type="text" wire:model="stock" class="mt-1 block w-full" placeholder="Stock"/>
            <x-jet-input-error for="stock" class="mt-2" />
        </div>
        <!-- Unit Price -->
        <div class="mt-4 ml-2">
            <x-jet-label for="unit_price" value="{{ __('Unit Price') }}" />
            <x-jet-input id="unit_price" type="text" wire:model="unit_price" class="mt-1 block w-full" placeholder="Unit Price"/>
            <x-jet-input-error for="unit_price" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Availability -->
        <div class="mt-4 mr-2">
            <x-jet-label for="select-availability" value="{{ __('Availability') }}" class="mb-1" />
                <select
                    wire:model="availability"
                    id="select-availability" 
                    style="width: 100%"
                    data-placeholder="{{ __('Select availability') }}"
                    data-allow-clear="false"
                    title="{{ __('Select availability') }}">
                    <option value="" selected>{{ __('Select availability') }}</option>
                    @foreach ($availabilityOptions as $availabilityKey => $availabilityvalue)
                        <option value="{{ $availabilityKey }}">{{ $availabilityvalue }}</option>
                    @endforeach
                </select>
            <x-jet-input-error for="availability" class="mt-2" />
        </div>
        <!-- Availability Date -->
        <div class="mt-3 ml-2">
            <x-jet-label for="availability_date" value="{{ __('Availability Date') }}" />
            <x-jet-input id="availability_date" wire:model="availability_date" class="block mt-1 w-full" type="date" />
            <x-jet-input-error for="availability_date" class="mt-2" />
        </div>
    </div>

    <!-- Photo -->
    <div class="mt-4">
        <x-jet-label for="photo" value="{{ __('Photo') }}" />
        <x-jet-input id="photo" type="file" wire:model="photo" class="mt-1 block w-full" placeholder="Photo"/>
        <x-jet-input-error for="photo" class="mt-2" />
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

<!-- Import -->
<x-jet-dialog-modal wire:model="isOpenImport">
  <x-slot name="title">
      {{ __('Import Products') }}
  </x-slot>

  <x-slot name="content">

    @if(Auth::user()->isAdmin())
    <!-- Warehouse -->
    <div class="mt-4">
        <x-jet-label for="select-warehouse" value="{{ __('Warehouse') }}" class="mb-1" />
            <select
                wire:model="warehouse_id"
                id="select-warehouse" 
                style="width: 100%"
                data-placeholder="{{ __('Select a warehouse') }}"
                data-allow-clear="false"
                title="{{ __('Select a warehouse') }}">
                <option value="" selected>{{ __('Select a warehouse') }}</option>
                @foreach ($warehouses as $warehouseKey => $warehousevalue)
                    <option value="{{ $warehouseKey }}">{{ $warehousevalue }}</option>
                @endforeach
            </select>
        <x-jet-input-error for="warehouse_id" class="mt-2" />
    </div>
    @endif
    <!-- Excel -->
    <div class="mb-4">
        <x-jet-label for="excel" value="{{ __('Excel') }}" />
        <x-jet-input id="excel" type="file" wire:model="excel" class="mt-1 block w-full"/>
        <x-jet-input-error for="excel" class="mt-2" />
    </div>
  </x-slot>

  <x-slot name="footer">
      <x-jet-secondary-button wire:click="closeModalImport" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-button class="ml-2" wire:click="import" wire:loading.attr="disabled">
          {{ __('Save') }}
      </x-jet-button>
  </x-slot>
</x-jet-dialog-modal>

<!-- Delete -->
<x-jet-dialog-modal wire:model="confirmingProductDeletion">
  <x-slot name="title">
      {{ __('Delete Product') }}
  </x-slot>

  <x-slot name="content">
      {{ __('Are you sure you want to delete product?') }}
  </x-slot>

  <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('confirmingProductDeletion')" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-danger-button class="ml-2" wire:click="delete({{ $confirmingProductDeletion }})" wire:loading.attr="disabled">
          {{ __('Delete Product') }}
      </x-jet-danger-button>
  </x-slot>
</x-jet-dialog-modal>