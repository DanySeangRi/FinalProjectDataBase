<header class="sticky top-0 z-50 bg-white shadow-sm">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex justify-between items-center h-16">


      <!-- Logo -->
      <div class="flex items-center gap-2">

        <div class="w-12 h-12">
          <img src="{{ asset('image/image.png') }}" class="logo mb-3">
        </div>

        <span class="text-xl font-bold">

          <span class="text-[#86C5FF]">
            Angkor
          </span>

          <span class="text-amber-400">
            Travels
          </span>

        </span>

      </div>



      <!-- Desktop Navigation -->

      <nav class="hidden md:flex gap-8">

        <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-500 transition">
          Home
        </a>


        <a href="{{ route('about') }}" class="text-gray-700 hover:text-amber-500 transition">
          About Us
        </a>


        <a href="{{ route('bookTrip') }}" class="text-gray-700 hover:text-amber-500 transition">
          Book Trip
        </a>


        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-amber-500 transition">
          Contact Us
        </a>




      </nav>



      <!-- Buttons -->

      <!-- Buttons -->

      <div class="hidden md:flex gap-3 items-center">


        @auth
          <span class="text-gray-700 font-medium">
            Welcome, {{ auth()->user()->first_name }}
          </span>

          <a href="{{ route('user.dashboard') }}"
            class="bg-[#86C5FF] text-white px-6 py-3 rounded-2xl hover:bg-[#107ce1] transition">
            Dashboard
          </a>

        @else

          <a href="{{ route('login') }}"
            class="border-2 border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-black transition">
            Login
          </a>

        @endauth

      </div>



      <!-- Mobile Menu Button -->

      <button id="menuBtn" class="md:hidden">

        <i data-lucide="menu"></i>

      </button>


    </div>



    <!-- Mobile Menu -->

    <div id="mobileMenu" class="hidden md:hidden flex-col gap-3 pb-5">


      <a href="/" class="py-2">
        Home
      </a>

      <a href="#" class="py-2">
        About Us
      </a>

      <a href="#" class="py-2">
        Boat Trip
      </a>

      <a href="#" class="py-2">
        Contact Us
      </a>

      <a href="#" class="py-2">
        FAQ
      </a>

      <a href="#" class="py-2">
        Membership
      </a>


    </div>


  </div>

</header>



<script>

  document
    .getElementById('menuBtn')
    ?.addEventListener('click', () => {

      document
        .getElementById('mobileMenu')
        .classList
        .toggle('hidden');

    });

</script>