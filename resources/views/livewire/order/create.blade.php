<div>
    @auth
        <div class="personal w-full border-t border-gray-400 pt-4">
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <input type="hidden" name="mode" value="SUBSCRIBE" />
                <h2 class="text-gray-900">收件人資訊</h2>
                
                <div class="items-center justify-between mt-4 md:flex">
                    <div class='w-full md:w-1/2 px-3 mb-6'>
                        <label class='block font-bold mb-2'>姓名</label>
                        <input name="name" wire:model="name" class='block w-full rounded-md' type='text' value='{{ old('name') }}' required>
                    </div>
                    <div class='w-full md:w-1/2 px-3 mb-6'>
                        <label class='block font-bold mb-2'>手機號碼</label>
                        <input id="phone-mask" name="mobile" wire:model="mobile" class='block w-full rounded-md' type='text'
                            value='{{ old('mobile') }}' placeholder='0900-000-000' required>
                    </div>
                </div>
                <div class='px-3 mb-6'>
                    <label class='block font-bold mb-2'>收件地址</label>
                    <div class="md:flex">
                        <div class='md:flex-none md:w-auto md:flex w-full pb-6 md:pr-3 md:pb-0'>
                            <select class="md:flex-grow block md:rounded-l-md md:rounded-tr-none rounded-t-md w-full"
                                name="city" wire:model="city" wire:loading.attr="disabled" wire:change="getDistricts">
                                <option>選擇縣市</option>
                                @foreach ($cities as $option)
                                    <option value="{{ $option['city'] }}">{{ $option['city'] }}</option>
                                @endforeach
                            </select>
                            <select
                                class="md:flex-grow block md:border-l-0 md:border-r-0 md:border-t md:border-b border-t-0 border-b-0 w-full"
                                name="district" wire:model="district" wire:loading.attr="disabled" wire:change="getRoads">
                                <option>選擇行政區</option>
                                @foreach ($districts as $option)
                                    <option value="{{ $option['district'] }}">{{ $option['district'] }}</option>
                                @endforeach
                            </select>
                            <select class="md:flex-grow block md:rounded-r-md md:rounded-bl-none rounded-b-md  w-full"
                                name="map_id" wire:model="map_id" wire:loading.attr="disabled" wire:change="getDistance">
                                <option value="0">選擇路名</option>
                                @foreach ($roads as $option)
                                    <option value="{{ $option['id'] }}">{{ $option['road'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input required type="text" name="address" wire:model="address" class="md:flex-grow block w-full rounded-md">
                    </div>
                    <div wire:loading.delay wire:target="getDistance">
                        <i class="fas fa-spinner animate-spin"></i> 計算運費中...
                    </div>
                    <div wire:loading.remove wire:target="getDistance">
                        <span>{{ $info }}</span>
                    </div>
                </div>
                <div class='w-full md:w-full px-3 mb-6'>
                    <label class='block font-bold mb-2'>附加訊息</label>
                    <textarea name="message"
                        class='rounded-md resize-none w-full h-20 py-2 px-3'>{{ old('message') }}</textarea>
                    <input type="checkbox" id="useLastInfo" wire:model="useLastInfo" wire:click="useLastInfo"> <label for="useLastInfo">使用上次資訊</label>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex px-3 mb-6">
                    <p>
                        運費計算規則：<br>
                        訂購滿300元即可外送，<br>
                        外送距離1公里內，免收外送費，<br>
                        外送距離1~4公里，訂購滿500元免加收60元外送費，<br>
                        外送距離4~6公里，訂購滿1000元免加收120元外送費。<br>
                        本島宅配--一律採用低溫宅配，配送地區依黑貓本島宅配規定，單件/1~13瓶運費260元，超過13瓶以第二件計算。由於星期日不收、送貨，為提高產品新鮮，到貨日請選擇週二~週六。(低溫宅配恕不接受貨到付款)。<br>
                        來店自取--免運費。<br>
                    </p>
                </div>
                <div class="flex justify-end">
                    <div class="text-right px-6">
                        <h1>總額: {{ number_format($cart->total + $fee) }}</h1>
                    </div>
                    <button class="btn btn-info" type="submit">確認送出</button>
                </div>
            </form>
        </div>

        <script>
            var phoneMask = IMask(
                document.getElementById('phone-mask'), {
                    mask: '0000-000-000'
                });
        </script>
    @else
        <div class="text-center w-full border-collapse p-6">
            <p class="text-lg">請先<a href="{{ route('login') }}"><span>登入</span></a>以填寫購買人訊息</p>
        </div>
    @endauth

</div>
