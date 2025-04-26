<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>{{ env('APP_NAME') }}</title>

  <!-- Tailwind CDN (latest version) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


  <!-- Vite assets -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-gray-900 text-lg leading-relaxed">
  <!-- Header -->
  <header class="bg-slate-800 shadow-lg">
    <nav class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">

      <a href="{{ route('posts.index')  }}" class="text-white text-2xl font-bold hover:text-slate-300 transition">Home</a>
      @auth
      <div class="relative" x-data="{ open: false }">
        <!-- Dropdown Toggle Button -->
        <button @click="open = !open" type="button" class="w-12 h-12 rounded-full overflow-hidden border-2 border-white focus:outline-none">
          <img src="https://picsum.photos/200" alt="User Avatar" class="w-full h-full object-cover">
        </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 overflow-hidden">
                        <p class="block px-4 py-2 text-sm text-gray-500 hover:bg-slate-100 transition">
                            {{ auth()->user()->name }}
                        </p>
                        <hr class="border-t border-gray-200">
                        <a href="{{ route('dashboard') }}"
                            class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2">Dashboard</a>

                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2">Logout</button>
                            </form>

                    </div>
                    </div>
            @endauth


      @guest
      <div class="flex items-center gap-6">
        <a href="{{ route('login') }}" class="text-white text-lg hover:text-slate-300 transition">Login</a>
        <a href="{{ route('register') }}" class="text-white text-lg hover:text-slate-300 transition">Register</a>
      </div>
      @endguest

    </nav>
  </header>

  <!-- Main Content -->
  <main class="py-12 px-6 max-w-5xl mx-auto text-xl">
    {{ $slot }}
  </main>


  <script>
    // Set form: x-data="formSubmit" @submit.prevent="submit" and button: x-ref="btn"
    document.addEventListener('alpine:init', () => {
        Alpine.data('formSubmit', () => ({
            submit() {
                this.$refs.btn.disabled = true;
                this.$refs.btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                this.$refs.btn.classList.add('bg-indigo-400');
                this.$refs.btn.innerHTML =
                    `<span class="absolute left-2 top-1/2 -translate-y-1/2 transform">
                    <i class="fa-solid fa-spinner animate-spin"></i>
                    </span>Please wait...`;

                this.$el.submit()
            }
        }))
    })
</script>

  <!-- Footer -->
<footer class="bg-slate-800 text-white py-6 mt-auto">
    <div class="max-w-7xl mx-auto text-center">
        <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
