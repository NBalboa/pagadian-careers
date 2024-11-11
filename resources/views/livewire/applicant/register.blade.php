<section class="bg-gray-50 py-5">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0">
        <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Register Account
                </h1>
                <form wire:submit.prevent="save">
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">
                                First Name<x-required /></label>
                            <input type="text" name="first_name" id="first_name" wire:model="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="">
                            @error('first_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">
                                Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" wire:model="middle_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="">
                            @error('middle_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">
                                Last Name<x-required /></label>
                            <input type="text" name="last_name" id="last_name" wire:model="last_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="">
                            @error('last_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                Email<x-required /></label>
                            <input type="email" name="email" id="email" wire:model="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">
                                Phone<x-required /></label>
                            <input type="text" name="phone" id="phone_no" wire:model="phone_no"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="">
                            @error('phone_no')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <div class="relative">

                                <input type="{{ $showPassword ? 'text' : 'password' }}" name="password" id="password"
                                    wire:model="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <button tabindex="-1" type="button" class="absolute top-0 right-0 bottom-0 me-2"
                                    wire:submit.prevent="save" wire:click.prevent="toggleShowPassword">
                                    @if ($showPassword)
                                        <i class="fa-solid fa-eye-slash"></i>
                                    @else
                                        <i class="fa-solid fa-eye "></i>
                                    @endif
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                                Password<x-required /></label>
                            <div class="relative">
                                <input type="{{ $showPassword ? 'text' : 'password' }}" name="confirm_password"
                                    wire:model="confirm_password" id="confirm_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <button tabindex="-1" type="button" class="absolute top-0 right-0 bottom-0 me-2"
                                    wire:submit.prevent="save" wire:click.prevent="toggleShowPassword">
                                    @if ($showPassword)
                                        <i class="fa-solid fa-eye-slash"></i>
                                    @else
                                        <i class="fa-solid fa-eye "></i>
                                    @endif
                                </button>
                            </div>
                            @error('confirm_password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="gender"
                                class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Gender<x-required /></label>
                            <select id="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                wire:model="gender">
                                <option selected value="">Select Gender</option>
                                <option value="{{ $MALE }}">MALE</option>
                                <option value="{{ $FEMALE }}">FEMALE</option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:loading wire:target="save">
                            <x-spinner />
                        </div>
                        <button type="submit" wire:loading.remove wire:target="save"
                            class="w-full text-white bg-blue-700 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create
                            Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
