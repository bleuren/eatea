<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('感謝您的註冊！ 在開始之前，您能否通過單擊我們剛剛通過電子郵件發送給您的連結來驗證您的電子郵件地址？ 如果您沒有收到電子郵件，我們很樂意向您發送另一封電子郵件。') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('新的驗證連結已發送到您在註冊時提供的電子郵件地址。 ') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('重新發送驗證電子郵件 ') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('登出') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
