<!-- Sidebar Menu -->
<div :class="{ '!translate-x-0': open }" class="fixed top-0 left-0 z-20 w-9/12 h-screen overflow-y-auto transition duration-300 ease-in-out transform -translate-x-full bg-white shadow-2xl sm:w-64 md:translate-x-0">
    <!-- Sidebar Header -->
    <div class="flex items-center h-20">
        <div class="inline-flex items-center justify-center w-full md:justify-center">
            <!-- Hamburger -->
            <a href="#" @click="open = !open" class="absolute right-0 top-0 mr-1.5 mt-1.5 inline-flex p-1 items-center justify-center rounded-md hover:bg-blue-100 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 stroke-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <!-- Logo -->
            <a href="{{ route('user.dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-700" />
            </a>
        </div>
    </div>
    <!-- Profile Section -->    
    <div class="divide-y divide-gray-100 divide-solid">
        <div class="p-5 text-center"> 
            <!-- Profile Info -->
            <div>
                <h3 class="mb-2 overflow-hidden text-2xl font-bold whitespace-nowrap overflow-ellipsis text-gray-800">{{ auth()->user()->name }}</h3>
            
            </div>
        </div>
    </div>
    <!-- Navigation Links -->
    <div class="flex flex-col mb-0 ml-0">
        <x-sidebar-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </x-slot>
            {{ __('Dashboard') }}
        </x-sidebar-nav-link>
        
        <x-sidebar-nav-link :href="route('profile.edit')">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class= "w-4 h-4 mr-4" height="1em" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
            </x-slot>
            {{ __('แก้ไขบัญชี') }}
        </x-sidebar-nav-link>
        
        <x-sidebar-nav-link href="{{route('calendar')}}">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class= "w-4 h-4 mr-4" height="1em" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>
            </x-slot>
            {{ __('ตารางจอง') }}
        </x-sidebar-nav-link>

        <x-sidebar-nav-link :href="route('bookings')">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-4" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
            </x-slot>
            {{ __('จองคิว') }}
        </x-sidebar-nav-link>

        <x-sidebar-nav-link :href="route('queueinfo')">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class = "h-4 w-4 mr-4"height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>
            </x-slot>
            {{ __('ดูรายละเอียดจองคิว') }}
        </x-sidebar-nav-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-sidebar-nav-link onclick="event.preventDefault();this.closest('form').submit();">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </x-slot>
                {{ __('ออกจากระบบ') }}
            </x-sidebar-nav-link>
        </form>
        
    </div>
</div>
<div :class="{ '!inline': open }" class="z-10 fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-30 hidden md:!hidden transition ease-in-out duration-300"></div>