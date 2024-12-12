<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body>
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
            <h1 class="ml-4 text-white text-xl font-bold"></h1>
            </div>
            <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4 ">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <!-- <a href="/pendaftaran-pasien" class="rounded-md px-3 py-2 text-sm font-medium text-white" aria-current="page">Pendaftaran</a> -->
                <!-- <a href="/jadwal-dokter" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Jadwal Dokter</a> -->
                <!-- <a href="/login" class="absolute right-0 rounded-md pb-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Logout</a> -->
            </div>
            </div>
        </div>
        
        </div>
    </div>
    </nav>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a class="flex items-center p-2 rounded-lg text-white group">
               <span class="ms-3">Rumah Sakit Almah</span>
            </a>
         </li>
         <!-- Menu untuk Admin -->
         @if($admin->role == 'admin' || $admin->role === 'petugas')
         <li>
            <a href="{{ route('verifikasi.pendaftaran') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Verifikasi Pendaftaran</span>
            </a>
         </li>
         @endif

         @if($admin->role === 'dokter')
         <li>
            <a href="{{ route('data.pasien.dokter') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Data Pasien</span>
            </a>
         </li>
         @endif


         <!-- Menu untuk Admin dan Dokter -->
         @if($admin->role == 'admin' || $admin->role === 'petugas')
         <li>
            <a href="{{ route('data.pasien') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Data Pasien</span>
            </a>
         </li>
         @endif

         <!-- Menu untuk Admin -->
         @if($admin->role == 'admin')
         <li>
            <a href="{{ route('data.petugas') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Data Petugas</span>
            </a>
         </li>
         <li>
            <a href="{{ route('data.dokter') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Data Dokter</span>
            </a>
         </li>
         @endif

         <!-- Logout untuk semua role -->
         <li>
            <a class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">
               <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form> 
               </span>
            </a>
         </li>

      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64">
@empty(trim($__env->yieldContent('content')))
        <h1 class="text-lg font-bold text-black">Selamat Datang {{ $admin->nama_admin }}</h1>
    @endempty

   <div class="p-4 rounded-lg border-gray-700">
   <main class="flex-1 p-4">
        @yield('content')
    </main>
   </div>
</div>




    <!-- <h1>Welcome to the Home Page</h1>
    <p>Nama Admin: {{ $admin->nama_admin }}</p>
    <p>Username: {{ $admin->username }}</p>
    <p>Role: {{ $admin->role }}</p> -->

    <!-- <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @yield('script')
   </body>

   </html>
