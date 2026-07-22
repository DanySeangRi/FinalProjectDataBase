<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Angor Travels')
    </title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    <script src="https://unpkg.com/lucide@latest"></script>


    <script src="https://cdn.tailwindcss.com"></script>


    <script>

        tailwind.config = {

            theme: {

                extend: {

                    colors: {

                        brand: {

                            50: '#eff6ff',

                            100: '#dbeafe',

                            500: '#3b82f6',

                            600: '#2563eb',

                        },

                    },

                },

            },

        }

    </script>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>



<body class="bg-white">


    {{-- Navbar --}}

    <x-navbar />




    {{-- Page Content --}}

    @yield('content')




    {{-- Footer --}}

   @if(!isset($hideFooter) || !$hideFooter)

  
     <x-home.footer />


@endif





<script>


lucide.createIcons();



document
    .getElementById('menuBtn')
    ?.addEventListener('click', () => {


        document
            .getElementById('mobileMenu')
            .classList
            .toggle('hidden');


    });


</script>


</body>


</html>