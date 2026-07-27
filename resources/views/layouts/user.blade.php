<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') · Angkor Travel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Using the Tailwind CDN build for a quick drop-in. --}}
    {{-- In a real app, swap this for your Vite-compiled resources/css/app.css --}}
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
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-slate-50 antialiased">

    <div class="w-full h-screen flex overflow-hidden">

        {{-- Sidebar component --}}
        <x-users.sidebar :active="$active ?? 'dashboard'" />

        {{-- Main content column --}}
        <div class="flex-1 flex flex-col min-h-0">
            <x-admin.topbar />

            <main class="flex-1 overflow-y-auto px-8 py-8">
                @yield('content')
            </main>

        </div>


        {{-- Page specific JavaScript --}}
        @stack('scripts')


</body>

</html>