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
                    <a href="{{ route('category', ['warehouse_id' => $warehouse->id]) }}" class="mr-2 text-sm font-medium text-gray-900">
                      {{ $warehouse->name }}
                    </a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                      <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                  </div>
                </li>

                <li class="text-sm">
                  <a href="{{ route('product-list', ['warehouse_id' => $warehouse->id, 'category' => $category]) }}" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">
                    {{ ucwords($category) }}
                  </a>
                </li>
              </ol>
            </nav>
         </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto py-16 sm:py-5 lg:py-5 lg:max-w-none">
                    <h2 class="text-2xl font-extrabold text-gray-900">{{ ucwords($category) }}</h2>
                    <div class="mt-6 space-y-12 lg:space-y-0 md:grid md:grid-cols-4 md:gap-x-6">
                        @foreach($products as $product)
                        <div class="group relative mr-3 ml-3">
                            <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                              <img src="{{ asset($product->photo) }}" alt="{{ $product->details_en }}" class="w-full h-full object-center object-cover">
                            </div>
                              <div class="mt-4 flex justify-between">
                                <div>
                                  <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('details', ['product_id' => $product->id]) }}">
                                      <span aria-hidden="true" class="absolute inset-0"></span>
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
                                  </h3>
                                  <p class="mt-1 text-sm text-gray-500">{{ __('Pieces') }}: {{ ucwords($product->pieces) }}</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">${{ ucwords($product->total_price) }}</p>
                              </div>
                              <div class="pb-3 w-full relative">
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
                                    <button type="submit" class="mt-10 w-full bg-indigo-600 border border-transparent rounded-md py-1 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Add to cart') }}</button>
                                </form>
                              </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>