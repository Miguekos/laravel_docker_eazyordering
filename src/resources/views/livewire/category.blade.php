<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white">

          <div class="pt-6">
            <nav aria-label="Breadcrumb">
              <ol role="list" class="max-w-2xl mx-auto px-4 flex items-center space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">

                <li>
                  <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="mr-2 text-sm font-medium text-gray-900">
                      {{ __('Warehouses') }}
                    </a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                      <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                  </div>
                </li>

                <li class="text-sm">
                  <a href="{{ route('category', ['warehouse_id' => $warehouse->id]) }}" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">
                    {{ $warehouse->name }}
                  </a>
                </li>
              </ol>
            </nav>
         </div>

          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-5 lg:py-5 lg:max-w-none">
              <h2 class="text-2xl font-extrabold text-gray-900">{{ __('Categories') }}</h2>

              <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                
                @foreach($categories as $category)

                <div class="group relative">
                  <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                    <a href="{{ route('product-list', ['warehouse_id' => $warehouse->id, 'category' => $category->category]) }}">
                    <img src="{{ asset($category->img) }}" title="{{ ucwords($category->category) }}" class="w-full h-full object-center object-cover">
                    </a>
                  </div>
                  <h3 class="mt-6 text-sm text-gray-500">
                    <a href="{{ route('product-list', ['warehouse_id' => $warehouse->id, 'category' => $category->category]) }}">
                      <p class="text-base font-semibold text-gray-900">{{ ucwords($category->category) }}</p>
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