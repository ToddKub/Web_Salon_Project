<x-default-layout>
<div  class="w-full h-full px-44 py-12 my-2">
    <div class="m-10 bg-slate-300 rounded-3xl pt-5 pb-5">
        <div class="px-24 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="px-24 ">
                @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="pt-2" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 " />
        </div>

        <div class="flex items-center justify-end mt-4 mx-auto">
            <x-primary-button>
                {{ __('ส่งอีเมลรีเซ็ต Password') }}
            </x-primary-button>
        </div>
    </form>
</div>
    </div>
    
    
</x-default-layout>
