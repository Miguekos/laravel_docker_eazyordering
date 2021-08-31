<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white">
          <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">

            <div class="flex items-start justify-between">
              <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                {{ __('Shopping cart') }}
              </h2>
            </div>

            <div class="mt-8">
              <div class="flow-root">
                <ul role="list" class="-my-6 divide-y divide-gray-200">

                    @foreach ($cartItems as $item)
                  <li class="py-6 flex">
                    <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                      <img src="{{ asset($item->attributes->photo) }}" alt="{{$item->name}}" class="w-full h-full object-center object-cover">
                    </div>

                    <div class="ml-4 flex-1 flex flex-col">
                      <div>
                        <div class="flex justify-between text-base font-medium text-gray-900">
                          <h3>
                            <a href="{{ route('details', ['product_id' => $item->id]) }}">
                              {{ $item->name }}
                            </a>
                          </h3>
                          <p class="ml-4">
                            ${{ $item->price }}
                          </p>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                          @if($item->attributes->pack_description != "" ){{ __('Pack Description') }}: {{ $item->attributes->pack_description }}<br>@endif
                          @if($item->attributes->pieces != "" ){{ __('Pieces') }}: {{ $item->attributes->pieces }}<br>@endif
                          @if($item->attributes->unit_weight != "" ){{ __('Unit Weight') }}: {{ $item->unit_weight }}{{ $item->uom }}@endif
                          
                        </p>
                      </div>
                      <div class="flex-1 flex items-end justify-between text-sm">
                        <p class="text-gray-500">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-6 text-center bg-gray-300" />
                                <button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">{{__('Update')}}</button>
                            </form>
                        </p>

                        <div class="flex">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">{{__('Remove')}}</button>
                            </form>                          
                        </div>

                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>

          </div>

          <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
              <p>Total</p>
              <p>${{ Cart::getTotal() }}</p>
            </div>
            <div class="mt-6">
                <div class="flex justify-center md:px-1 py-3">                  
                  <form action="{{ route('order.store') }}" method="POST">
                      @csrf
                      <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">{{ __('Checkout') }}</button>
                  </form>   
                </div>
            </div>
            <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
              <p>
                or <a href="{{ route('dashboard') }}" class="text-indigo-600 font-medium hover:text-indigo-500">{{ __('Continue Shopping') }}<span aria-hidden="true"> &rarr;</span></a>
              </p>
            </div>
          </div>

        </div>
    </div>
</div>
