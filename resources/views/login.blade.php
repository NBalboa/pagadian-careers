<x-applicant-layout>
    <section class="bg-gray-50 mx-2">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <form id="login" class="space-y-4 md:space-y-6" action="/signin" method="POST">
                        @csrf
                        <div>
                            @error('error')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <label for="emailOrPhone" class="block mb-2 text-sm font-medium text-gray-900">
                                Email/Phone</label>
                            <input type="text" name="emailOrPhone" id="emailOrPhone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="" value="{{ old('emailOrPhone') }}">
                            @error('emailOrPhone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <button id="showPassword" tabindex="-1" type="button"
                                    class="absolute top-0 right-0 bottom-0 me-2">
                                    <i class="fa-solid fa-eye-slash"></i>
                                    {{-- <i class="fa-solid fa-eye "></i> --}}
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start hidden">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500">Remember me</label>
                                </div>
                            </div>
                            <a href="/forgot-password"
                                class="text-sm font-medium text-primary-600 hover:underline">Forgot
                                password?</a>
                        </div>
                        <button type="submit" id="login-btn"
                            class="w-full text-white bg-blue-700 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign in</button>
                        <div id="spinner" style="display: none">
                            <x-spinner />
                        </div>
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an account yet? <a href="/register"
                                class="font-medium text-primary-600 text-blue-700 hover:underline">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-applicant-layout>
