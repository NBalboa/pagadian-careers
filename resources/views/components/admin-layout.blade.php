@props([
    'title' => 'Pagadian Careers',
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c393acf5ae.js" crossorigin="anonymous"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <button id="open-sidebar-btn" data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0"
        aria-label="Sidebar">
        <div
            class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-br from-blue-600 to-blue-500 rounded-tr-2xl rounded-br-2xl space-y-5 shadow-lg">
            <button id="close-sidebar-btn" data-drawer-target="sidebar" data-drawer-toggle="sidebar"
                aria-controls="sidebar" type="button"
                class="absolute top-0 right-3 p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 z-50 md:hidden">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
            <div class="border-b-4 rounded border-blue-800  ">
                <h2 class="text-gray-900  font-medium text-xl text-white font-bolder">{{ auth()->user()->first_name }}
                    {{ auth()->user()->last_name }}
                </h2>
                <span class="ms-1 font-bold text-sm text-center text-blue-100 uppercase font-semibold">Admin</span>
            </div>
            <ul class="space-y-2 font-medium">
                <x-nav-item href="/dashboard" :active="Route::is('admin.dashboard')">
                    Dashboard
                </x-nav-item>
                <x-nav-item href="/company" :active="Route::is('admin.company') ||
                    Route::is('admin.company.create') ||
                    Route::is('admin.company.edit')">
                    Company
                </x-nav-item>
                <x-nav-item href="/hiringmanager" :active="Route::is('admin.hm') || Route::is('admin.create.hm') || Route::is('admin.edit.hm')">
                    Hiring Manager
                </x-nav-item>
                <x-nav-item href="/applicants" :active="Route::is('admin.applicants')">
                    Applicant
                </x-nav-item>
                <x-nav-item href="/account-settings" :active="Route::is('admin.settings')">
                    Account Settings
                </x-nav-item>
                <form action="/logout" method="POST"
                    class="p-2 rounded-lg text-white hover:bg-gray-200 hover:text-blue-700  hover:bg-gray-100  group cursor-pointer">
                    @csrf
                    <input type="submit" value="Logout" class="cursor-pointer w-full text-left ms-3" />
                </form>
            </ul>
        </div>
    </aside>
    <main class="p-4 md:ml-64 ">
        {{ $slot }}
    </main>

    <script src="/js/sidebar.js"></script>
    <script src="/js/contact-validation.js"></script>
    <script src="/js/address.js"></script>
</body>

</html>
