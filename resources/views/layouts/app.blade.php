<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'One Track')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-gradient-to-r from-blue-600 to-blue-800 shadow sticky top-0 z-20">
    <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-3 items-center">

      <!-- Brand -->
      <div class="flex items-center gap-3">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <h1 class="text-2xl font-bold text-white tracking-wide">One Track</h1>
      </div>

      <!-- Navigation -->
      <nav class="hidden md:flex items-center justify-center gap-8 text-sm font-medium text-white">
        <a href="{{ url('/dashboard') }}" class="hover:text-blue-200 transition duration-200">Dashboard</a>
        <a href="{{ url('/asset') }}" class="hover:text-blue-200 transition duration-200">Assets</a>
        <a href="{{ url('/history') }}" class="hover:text-blue-200 transition duration-200">History Log</a>
      </nav>

      <!-- Logout -->
      <div class="flex justify-end">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"
            class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
            </svg>
            Logout
          </button>
        </form>
      </div>
    </div>

  <!-- Mobile Nav -->
  {{-- <div class="md:hidden bg-blue-700 px-6 pb-4">
    <nav class="flex flex-col gap-3 text-sm font-medium text-white">
      <a href="{{ url('/dashboard') }}" class="hover:text-blue-200 transition">Dashboard</a>
      <a href="{{ url('/asset') }}" class="hover:text-blue-200 transition">Assets</a>
      <a href="{{ url('/history') }}" class="hover:text-blue-200 transition">History Log</a>
    </nav>
  </div> --}}
</header>



  <!-- Main -->
  <main class="flex-grow px-2 sm:px-4 py-4 sm:py-8 max-w-7xl mx-auto space-y-4 sm:space-y-6 w-full">
    @include('components.alert')
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-white text-center py-4 text-sm text-gray-500 border-t w-full">
    &copy; {{ date('Y') }} One Track — All Rights Reserved
  </footer>

</body>
</html>