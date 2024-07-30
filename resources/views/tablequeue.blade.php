<x-appu-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ปฎิทินจองคิว') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border-gray-200">
                <div class="p-10 text-gray-900">
                    <div x-data="{ events: [] }" x-init="fetchEvents()">
                        <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</x-appu-layout>

