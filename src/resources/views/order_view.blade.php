@extends('layouts.app')

@section('content')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:px-6">
          {{ __('Order') }} # {{ $order->id }}
      </h2>
    </div>
</header>
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
          <div class="flow-root">
            <ul role="list" class="-my-6 divide-y divide-gray-200">
            @foreach($order->products as $product)
              <li class="py-6 flex">
                <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                  <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="w-full h-full object-center object-cover">
                </div>

                <div class="ml-4 flex-1 flex flex-col">
                  <div>
                    <div class="flex justify-between text-base font-medium text-gray-900">
                      <h3>
                        <a href="{{ route('details', ['product_id' => $product->id]) }}">
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
                      <p class="ml-4">
                        ${{ ($product->total_price)*($product->pivot->quantity) }}
                      </p>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                      @if(isset($product->pack_description) ){{ __('Pack Description') }}: {{ ucwords($product->pack_description) }}<br>@endif
                      @if(isset($product->pieces) ){{ __('Pieces') }}: {{ $product->pieces }}<br>@endif
                      @if(isset($product->unit_weight) ){{ __('Unit Weight') }}: {{ $product->unit_weight }}{{ $product->uom }}@endif
                      
                    </p>
                  </div>
                </div>
              </li>
            @endforeach
            </div>
          </div>


          <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
              <p>Total</p>
              <p>${{ $order->total }}</p>
            </div>
          </div>

        </div>
    </div>
</div>
@endsection