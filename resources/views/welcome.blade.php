<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
                Icon when menu is closed.

                Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
                Icon when menu is open.

                Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex shrink-0 items-center">
            <img class="h-12 w-auto rounded-full" src="https://png.pngtree.com/png-clipart/20200401/original/pngtree-hospital-icon-design-illustration-png-image_5339806.jpg" alt="Your Company">
            <h1 class="ml-4 text-white text-xl font-bold">Rumah Sakit Almah</h1>
            </div>
            <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4 ">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="/pendaftaran" class="rounded-md px-3 py-2 text-sm font-medium text-white" aria-current="page">Pendaftaran</a>
                <a href="/jadwal-dokter" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Jadwal Dokter</a>
                <a href="/login" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Login</a>
            </div>
            </div>
        </div>
        
        </div>
    </div>
    </nav>
    <div class="h-screen flex items-center justify-center ">
        <h1 class="text-3xl font-bold ">Informasi Tentang Rumah Sakit Almah</h1>
    </div>
</body>
</html>
