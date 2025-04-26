<x-layout>
    <h1 class="text-2xl text-center font-bold mb-6">Register a new account</h1>

    <div class="mx-auto max-w-screen-md bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('register') }}" method="post"  x-data="formSubmit" @submit.prevent="submit"  >
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2
                    @error('name') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>



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

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                    @error('password') border-red-500 focus:ring-red-500 @enderror">
            </div>

            <div class="mb-4">
                <input type="checkbox" name="subscribe" id="subscribe" class="mr-2">
                <label for="subscribe" class="text-sm font-medium text-slate-700">Subscribe to our newsletter</label>
            </div>

            {{-- Submit Button --}}
            <button type="submit" x-ref="btn"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                Register
            </button>
        </form>
    </div>
</x-layout>
