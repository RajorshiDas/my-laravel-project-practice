<x-layout>
    <h1 class="text-2xl text-center font-bold mb-6">Welcome Back!</h1>

    <div class="mx-auto max-w-screen-md bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('login') }}" method="post">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2
                    @error('email') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2
                    @error('password') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me and Forgot Password --}}
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-slate-700">Remember Me</label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-500 hover:text-blue-700">Forgot Password?</a>
                </div>
            </div>

            @error('failed')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                Login
            </button>
        </form>
    </div>
</x-layout>
