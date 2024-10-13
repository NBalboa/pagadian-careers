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
    <script src="/js/sidebar.js"></script>
    <script src="/js/contact-validation.js"></script>
    <script src="/js/address.js"></script>
    @vite('resources/css/app.css')
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
        <div class="h-full px-3 py-4 overflow-y-auto bg-blue-100 ">
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
            <div class="border-b-2 border-black ">
                <h2 class="p-3 text-gray-900  font-medium text-xl relative">{{ auth()->user()->first_name }}
                    {{ auth()->user()->last_name }}
                    <span
                        class="absolute text-blue-400 text-xs px-3 transition-transform transform translate-y-1 bottom-2 left-0">Admin</span>
                </h2>

            </div>
            <ul class="space-y-2 font-medium">
                <x-nav-item href="/dashboard">
                    Dashboard
                </x-nav-item>
                <x-nav-item href="/hiringmanager">
                    Hiring Manager
                </x-nav-item>
                <x-nav-item href="/company">
                    Company
                </x-nav-item>
                <x-nav-item href="/applicants">
                    Applicant
                </x-nav-item>
                <form action="/logout" method="POST"
                    class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group active cursor-pointer">
                    @csrf
                    <input type="submit" value="Logout" class="ms-3" />
                </form>
            </ul>
        </div>
    </aside>
    <main class="p-4 md:ml-64 ">
        {{ $slot }}
    </main>
</body>

</html>
