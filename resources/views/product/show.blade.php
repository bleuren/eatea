@extends('layouts.site')

@section('content')
    <section>
        <div class="container">
            <div
                class="h-full md:h-80 m-auto justify-center bg-white p-2 w-80 max-w-3xl sm:w-full sm:p-4 sm:h-64 rounded-2xl shadow-lg flex flex-col sm:flex-row gap-5 select-none">
                <div style='background: url("https://images.unsplash.com/photo-1426604966848-d7adac402bff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8bmF0dXJlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60")'
                    class="h-52 sm:h-full sm:w-72 rounded-xl bg-gray-100 bg-center bg-cover"></div>
                <div x-data="{ count: 0, mode : 'SUBSCRIBE' }" x-init="count = $refs.received_at.value.split(', ').length"
                    class="flex sm:flex-1 flex-col gap-2 p-1">
                    <h1 class="head-text text-2xl lg:text-4xl font-semibold text-gray-600">
                        {{ $product->name }}
                    </h1>
                    <p class="text-gray-500 text-sm sm:text-base line-clamp-3">
                        {!! $product->body !!}
                    </p>
                    <p x-show="mode === 'SUBSCRIBE'">
                        數量: <span x-html="count"></span> (依照訂閱日期更新)
                    </p>
                    <div class="flex justify-end mt-auto">
                        <div class="container flex justify-center items-center">
                            <div class="relative">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <select @change="mode = $event.target.value" name="mode" autocomplete="mode">
                                        <option value="SUBSCRIBE">訂閱</option>
                                        <option value="PICKUP">店取</option>
                                        <option value="DELIVERY">宅配</option>
                                    </select>
                                    <input type="hidden" name="id" value="{{ $product->id }}" />
                                    <input x-show="mode !== 'SUBSCRIBE'" type="number" name="qty"
                                        placeholder="{{ __('輸入數量') }}" />
                                    <input type="text" x-show="mode === 'SUBSCRIBE'" name="received_at" x-ref="received_at"
                                        x-on:change="count = $refs.received_at.value.split(', ').length"
                                        class="subscribe rounded-lg z-0 focus:shadow focus:outline-none"
                                        placeholder="{{ __('設定訂閱日期') }}" />
                                    <div class="absolute top-2 right-2"> <button type="submit"
                                            class="w-24 text-white rounded-lg bg-red-500 hover:bg-red-600">加入購物車</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
