<!-- View -->
<x-jet-dialog-modal wire:model="isOpenView">
  <x-slot name="title">
      {{ __('View Product') }}
  </x-slot>

  <x-slot name="content">

    <div class="bg-white">
      <div class="max-w-2xl mx-auto py-24 px-4 grid items-center grid-cols-1 gap-y-16 gap-x-8 sm:px-6 sm:py-6 lg:max-w-7xl lg:px-8 lg:grid-cols-2">
        <div>
          <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
              @if(app()->getLocale() == 'en')
                {{ ucwords($this->description_en) }}
              @elseif(app()->getLocale() == 'es')
                {{ $this->description_es != '' ? ucwords($this->description_es) : ucwords($this->description_en)}}
              @elseif(app()->getLocale() == 'it')
                {{ $this->description_it != '' ? ucwords($this->description_it) : ucwords($this->description_en)}}
              @else
                {{ ucwords($this->description_en) }}
              @endif
          </h2>

          <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">

            @if(!empty($this->warehouse_id))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Warehouse') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->warehouse_id }}</dd>
            </div>
            @endif

            @if(!empty($this->category))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Category') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ ucwords($this->category) }}</dd>
            </div>
            @endif

            @if(!empty($this->family))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Family') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ ucwords($this->family) }}</dd>
            </div>
            @endif

            @if(!empty($this->unit_weight))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Unit Weight') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->unit_weight }}</dd>
            </div>
            @endif

            @if(!empty($this->total_weight))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Total Weight') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->total_weight }}</dd>
            </div>
            @endif

            @if(!empty($this->pieces))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Pieces') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->pieces }}</dd>
            </div>
            @endif

            @if(!empty($this->uom))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Unit of Measurement') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ ucwords($this->uom) }}</dd>
            </div>
            @endif

            @if(!empty($this->pack_description))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Pack Description') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ ucwords($this->pack_description) }}</dd>
            </div>
            @endif

            @if(!empty($this->stock))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Stock') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->stock }}</dd>
            </div>
            @endif

            @if(!empty($this->availability_date))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Availability Date') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->availability_date }}</dd>
            </div>
            @endif

            @if(!empty($this->unit_price))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Unit Price') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->unit_price }}</dd>
            </div>
            @endif

            @if(!empty($this->total_price))
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{{ __('Total Price') }}</dt>
              <dd class="mt-2 text-sm text-gray-500">{{ $this->total_price }}</dd>
            </div>
            @endif

          </dl>
        </div>

        @if(!empty($this->photo))
        <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
          <img src="{{ asset($this->photo) }}" alt="Walnut card tray with white powder coated steel divider and 3 punchout holes." class="bg-gray-100 rounded-lg">
        </div>
        @endif

      </div>
    </div>

  </x-slot>

  <x-slot name="footer">
      <x-jet-button class="ml-2" wire:click="closeModalView" wire:loading.attr="disabled">
          {{ __('Close') }}
      </x-jet-button>
  </x-slot>
</x-jet-dialog-modal>