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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen flex flex-col">
    @if (Route::is('home') ||
            Route::is('jobs') ||
            Route::is('my/jobs') ||
            Route::is('my/profile') ||
            Route::is('registerregister') ||
            Route::is('login') ||
            Route::is('app.job'))

        <div class="w-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-bold text-blue-600 hover:opacity-80 whitespace-nowrap">Pagadian
                    Careers</span>
            </a>
            <button data-collapse-toggle="navbar-solid-bg" type="button" id="navbar-button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                aria-controls="navbar-solid-bg" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul
                    class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent   ">
                    <x-app-link :active="Route::is('home')" to="/">
                        Home
                    </x-app-link>

                    @guest
                        <x-app-link :active="Route::is('login')" to="/login">
                            Login
                        </x-app-link>
                        <x-app-link :active="Route::is('registerregister')" to="/register">
                            Register
                        </x-app-link>
                    @endguest
                    @auth
                        @if (auth()->user()->role === 1)
                            <x-app-link :active="Route::is('jobs') || Route::is('app.job')" to="/jobs">
                                Jobs
                            </x-app-link>
                            <x-app-link :active="Route::is('my/jobs')" to="/my/jobs">
                                My Jobs
                            </x-app-link>
                            <x-app-link :active="Route::is('my/profile')" to="/my/profile">
                                Profile
                            </x-app-link>
                        @else
                            <li>
                                <a href="{{ auth()->user()->role === 0 ? '/dashboard' : '/hiringmanager/dashboard' }}"
                                    class="block py-2 px-3 md:p-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700">
                                    Dashboard
                                </a>
                            </li>
                        @endif
                        <form action="/logout" method="POST"
                            class="block py-2 px-3 md:p-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 cursor-pointer">
                            @csrf
                            <input type="submit" value="Logout" class="cursor-pointer" />
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    @endif
    <main>
        {{ $slot }}
    </main>

    <footer class="bg-gray-100 mt-auto">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="flex flex-col items-center">
                        <span class="self-center text-3xl text-blue-700 font-bold whitespace-nowrap">Pagadian
                            Careers</span>
                        <span class="self-center text-sm text-gray-600 whitespace-nowrap">Plaza Luz, Pagadian
                            City</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Contacts</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">pagadiancareers@info.com</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">09123456789</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Social Media</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline ">Facebook</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Legal</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center ">
                <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="/"
                        class="hover:underline">Pagadian Careers</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>

    <script src="/js/navbar.js"></script>
    <script src="/js/contact-validation.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/showPassword.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
