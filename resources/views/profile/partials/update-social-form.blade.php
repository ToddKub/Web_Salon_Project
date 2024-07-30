<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('เชื่อมต่อรับแจ้งเตือน') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('ทำกดเชื่อมต่อ จากนั้นทำการ Login Line เพื่อรับการแจ้งเตือนจาก Line') }}
        </p>
    </header>

    <div class="mt-3">
            <a href="{{ route('line-notify') }}" class="px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-700">รับการแจ้งเตือน Line</a>    
    </div>
</section>

