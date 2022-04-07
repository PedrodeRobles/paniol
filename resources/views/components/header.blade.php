<div class="flex justify-between bg-blue-500 w-full h-20 border-y-2 border-gray-500">
    <a href="{{ url('/') }}" class="w-44 ml-2">
        <img src="{{ asset('/img/logoCitlam.png') }}" alt="Logo Citlam" class="mb-2">
    </a>
    <div>
        @if (Route::has('login'))
            <div class="top-0 right-0 px-6 py-4 sm:block mt-2 space-x-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white text-xl">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white text-xl">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white text-xl">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>