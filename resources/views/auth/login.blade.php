<x-guest-layout>
    <!-- Session Status -->
    <!-- Left: Image -->
    <div class="w-1/2  hidden lg:block -mt-40 h-full ">
        <img src="{{ URL::asset('/img/o4.png') }}" alt="Placeholder Image" class="object-cover w-full h-screen rounded-md">
    </div>
    <div class="p-8 w-full lg:w-1/2  px-36 py-3 -mt-20">
        <h1 class="text-xl font-semibold mb-4 text-center">ยินดีต้อนรับสู่ร้าน Raviporn Beauties</h1>
        <div class="container rounded mx-2 sm:mx-5 bg-red-300 text-center">
            <div class ="block mb-5"></div>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('อีเมล')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('รหัสผ่าน')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="my-4">
                <x-auth-session-status class="mb-4" :status="session('status')" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center mt-4 sm:flex-row sm:justify-between">
                @if (Route::has('password.request'))
                    <a class="underline text-sm mb-3 text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap"
                        href="{{ route('password.request') }}">
                        {{ __('ลืมรหัสผ่าน?') }}
                    </a>
                @endif
                <x-primary-button class="ml-3 sm:mt-2">
                    {{ __('ลงชื่อเข้าใช้งาน') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-center mt-5">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('ยังไม่มีบัญชี ? กดสมัครที่นี่') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
