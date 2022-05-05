<div>
    <div class="flex items-center justify-between py-2 px-6">
        <div>
            <span class="text-lg font-bold text-gray-800">{{ $startsAt->format('F') }}</span>
            <span class="ml-1 text-lg text-gray-600 font-normal">{{ $startsAt->format('Y') }}</span>
        </div>
        <div>
            <div class="bg-green-400 text-white inline-flex w-3 h-3 rounded-full"></div><span class="ml-1">已送達</span>
            <div class="bg-red-400 text-white inline-flex w-3 h-3 rounded-full"></div><span class="ml-1">待送</span>
            <div class="bg-yellow-400 text-white inline-flex w-3 h-3 rounded-full"></div><span class="ml-1">未取</span>
        </div>
        <div class="border rounded-lg px-1" style="padding-top: 2px;">
            <button wire:click.stop="goToPreviousMonth" type="button"
                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center">
                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            {{-- <div class="border-r inline-flex h-6"></div>
            <button wire:click.stop="goToCurrentMonth" type="button" class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1">
                <span class="h-6 m-auto text-gray-500 inline-flex leading-none">NOW</span>
            </button> --}}
            <div class="border-r inline-flex h-6"></div>
            <button wire:click.stop="goToNextMonth" type="button"
                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1">
                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
