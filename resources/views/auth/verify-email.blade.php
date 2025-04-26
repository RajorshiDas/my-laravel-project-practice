<x-layout>

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Please verify your email address</h1>
        <p class="text-gray-600 mb-4">We have sent a verification link to your email address. Please check your inbox and click the link to verify your email.</p>
        <p class="text-gray-600 mb-6">If you did not receive the email, you can request a new verification link by clicking the button below.</p>
        <form method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                Resend Verification Email
            </button>
        </form>
    </div>

</x-layout>
S
