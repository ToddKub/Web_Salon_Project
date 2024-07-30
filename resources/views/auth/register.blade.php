<x-guest-layout>
    
    <!-- Left: Image -->
    <div class="w-1/2  hidden lg:block -mt-40 h-full">
        <img src="{{URL::asset('/img/o1.png')}}" alt="Placeholder Image" class="object-cover w-full h-screen rounded-2xl">
    </div>
    <div class="p-8 w-full lg:w-1/2  px-36 py-3 -mt-20">
        <h1 class="text-xl font-semibold mb-4 text-center">ยินดีต้อนรับสู่ร้าน  Raviporn Beauties</h1> 
        <div class="container rounded mx-2 sm:mx-5 bg-red-300 text-center">
        
        <div class ="block mb-5"></div>
        </div>
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('ชื่อ - นามสกุล')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="ชื่อ - นามสกุล"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('อีเมล')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autocomplete="username" placeholder="youremail@DomainEmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!--Phone-->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('เบอร์โทรศัพท์')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"  autocomplete="phone" placeholder="เบอร์โทรศัพท์" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('รหัสผ่าน')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="new-password" placeholder="รหัสผ่าน" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('ยืนยันรหัสผ่านอีกครั้ง')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" autocomplete="new-password" placeholder="ยืนยันรหัสผ่าน" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center mt-4 sm:flex-row sm:justify-between">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('มีบัญชีแล้ว ? กดเข้าสู่ระบบที่นี่') }}
            </a>

            <x-primary-button class="ml-4 mt-2">
                {{ __('สมัคร') }}
            </x-primary-button>
        </div>
    </form>
    </div>
</x-guest-layout>
