<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-5 lg:py-5 lg:max-w-none">
              <h2 class="text-2xl font-extrabold text-gray-900">{{ __('Warehouses') }}</h2>

              <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                
                @foreach($warehouses as $warehouse)

                <div class="group relative">
                  <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                    <a href="{{ route('category', ['warehouse_id' => $warehouse->id]) }}">
                    <img src="{{ $warehouse->profile_photo_url }}" alt="{{ $warehouse->name }}" class="w-full h-full object-center object-cover">
                    </a>
                  </div>
                  <h3 class="mt-6 text-sm text-gray-500">
                    <a href="{{ route('category', ['warehouse_id' => $warehouse->id]) }}">
                      <p class="text-base font-semibold text-gray-900">{{ ucwords($warehouse->name) }}</p>
                    </a>
                  </h3>          
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

