<x-layout>
    <h1 class="text-2xl text-center font-bold mb-6">Request a password to reset email</h1>

    @if (session('status'))
    <x-flashMsg msg="{{ session('status') }}" />
@endif

    <div class="mx-auto max-w-screen-md bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('password.request') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            {{-- Email --}}
            <div class="mb-8">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2
                    @error('email') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" x-ref="btn"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                Send Password Reset Link
            </button>
        </form>

    </div>



</x-layout>
