<div>
    <section class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Change Password
                        <span wire:loading wire:target="changePassword">
                            <x-loading />
                        </span>
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit.prevent="changePassword">
                        <div>
                            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New
                                Password</label>

                            <div class="relative">
                                <input type="{{ $showPassword ? 'text' : 'password' }}" name="new_password"
                                    id="new_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="" wire:model="new_password">

                                <button class="absolute top-0 right-0 bottom-0 me-2"
                                    wire:click.prevent="toggleShowPassword">
                                    @if ($showPassword)
                                        <i class="fa-solid fa-eye-slash"></i>
                                    @else
                                        <i class="fa-solid fa-eye "></i>
                                    @endif
                                </button>
                                @error('new_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                                Password</label>

                            <div class="relative">
                                <input type="{{ $showPassword ? 'text' : 'password' }}" name="confirm_password"
                                    id="confirm_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="" wire:model="confirm_password">

                                <button class="absolute top-0 right-0 bottom-0 me-2"
                                    wire:click.prevent="toggleShowPassword">
                                    @if ($showPassword)
                                        <i class="fa-solid fa-eye-slash"></i>
                                    @else
                                        <i class="fa-solid fa-eye "></i>
                                    @endif
                                </button>
                                @error('confirm_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
