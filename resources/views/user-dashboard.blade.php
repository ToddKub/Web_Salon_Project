<x-appu-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User dashboard') }}
        </h2> 
    </x-slot>
    <div class="my-12 mx-auto">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-100">
                <div class="pt-12 pb-24 text-gray-900">
                    <img class="w-52 h-59 mx-auto" src="{{ URL::asset('/img/rv1.jpg') }}">
                    <p class="font-mono text-2xl font-bold text-center">ยินดีต้อนรับ คุณ {{ auth()->user()->name }}</p>
                    <p class="font-mono text-2xl font-bold text-center">ที่เข้ามาใช้บริการ</p>    
                </div>
            </div>
        </div>
    </div>
</x-appu-layout>