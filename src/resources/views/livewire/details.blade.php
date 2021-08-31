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

              <li>
                <div class="flex items-center">
                  <a href="{{ route('category', ['warehouse_id' => $product->warehouse_id]) }}" class="mr-2 text-sm font-medium text-gray-900">
                    {{ $product->warehouse->name }}
                  </a>
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                  </svg>
                </div>
              </li>

              <li>
                <div class="flex items-center">
                  <a href="{{ route('product-list', ['warehouse_id' => $product->warehouse_id, 'category' => $product->category]) }}" class="mr-2 text-sm font-medium text-gray-900">
                    {{ ucwords($product->category) }}
                  </a>
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                  </svg>
                </div>
              </li>

              <li class="text-sm">
                <a href="{{ route('details', ['product_id' => $product->id]) }}" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">
                  @if(app()->getLocale() == 'en')
                    {{ ucwords($product->description_en) }}
                  @elseif(app()->getLocale() == 'es')
                    {{ $product->description_es != '' ? ucwords($product->description_es) : ucwords($product->description_en)}}
                  @elseif(app()->getLocale() == 'it')
                    {{ $product->description_it != '' ? ucwords($product->description_it) : ucwords($product->description_en)}}
                  @else
                    {{ ucwords($product->description_en) }}
                  @endif
                </a>
              </li>
            </ol>
          </nav>

          <!-- Image gallery -->
          <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">

            <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
              <img src="{{ asset($product->photo) }}" alt="{{ $product->description_en }}" class="w-full h-full object-center object-cover">
            </div>
            <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
              <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                @if(app()->getLocale() == 'en')
                  {{ ucwords($product->description_en) }}
                @elseif(app()->getLocale() == 'es')
                  {{ $product->description_es != '' ? ucwords($product->description_es) : ucwords($product->description_en)}}
                @elseif(app()->getLocale() == 'it')
                  {{ $product->description_it != '' ? ucwords($product->description_it) : ucwords($product->description_en)}}
                @else
                  {{ ucwords($product->description_en) }}
                @endif
              </h1>
              </div>
              <div class="mt-10">
                <h3 class="text-sm font-medium text-gray-900">{{ __('Details') }}</h3>

                <div class="mt-4">
                  <ul role="list" class="pl-4 list-disc text-sm space-y-2">

                    @if(!empty($product->family))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Family') }}: {{ ucwords($product->family) }}</span></li>
                    @endif

                    @if(!empty($product->pack_description))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Pack Description') }}: {{ ucwords($product->pack_description) }}</span></li>
                    @endif

                    @if(!empty($product->unit_weight))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Unit Weight') }}: {{ $product->unit_weight }}{{ $product->uom }}</span></li>
                    @endif

                    {{--
                    @if(!empty($product->uom))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Unit of Measurement') }}: {{ $product->uom }}</span></li>
                    @endif
                    --}}

                    @if(!empty($product->pieces))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Pieces') }}: {{ $product->pieces }}</span></li>
                    @endif

                    @if(!empty($product->total_weight))
                      <li class="text-gray-400"><span class="text-gray-600">{{ __('Total Weight') }}: {{ $product->total_weight }}</span></li>
                    @endif


                  </ul>
                </div>
              </div>
            </div>
            <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
            <div class="mt-4 lg:mt-0 lg:row-span-3">
              <h2 class="sr-only">{{ __('Product Information') }}</h2>
              <p class="text-3xl text-gray-900">${{ $product->total_price }}</p>

                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="id">
                    <input type="hidden" value="{{ $product->description_en }}" name="name">
                    <input type="hidden" value="{{ $product->total_price }}" name="price">
                    <input type="hidden" value="{{ $product->path }}"  name="image">
                    <input type="hidden" value="{{ $product->uom }}"  name="uom">
                    <input type="hidden" value="{{ $product->unit_weight }}"  name="unit_weight">
                    <input type="hidden" value="{{ $product->pieces }}"  name="pieces">
                    <input type="hidden" value="{{ $product->pack_description }}"  name="pack_description">
                    <input type="hidden" value="1" name="quantity">
                    <button type="submit" class="mt-10 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Add to cart') }}</button>
                </form>
              {{--
              <form class="mt-10">
                <button type="submit" class="mt-10 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Add to cart') }}</button>
              </form>
              --}}
            </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
