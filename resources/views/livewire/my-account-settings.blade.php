<div>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <x-form-wrapper>

            <div>
                <h2 class="text-3xl mb-2">Account Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                            First Name<x-required /></label>
                        <input type="text" name="first_name" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="first_name" />
                        <div class="text-red-600">
                            @error('first_name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Middle Name<x-required /></label>
                        <input type="text" name="middle_name" id="middle_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="middle_name" />
                        <div class="text-red-600">
                            @error('middle_name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Last Name<x-required /></label>
                        <input type="text" name="last_name" id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="last_name" />
                        <div class="text-red-600">
                            @error('last_name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button
                    class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    wire:click='saveChangesAccountInformation'>Save Changes</button>
            </div>
        </x-form-wrapper>
        <x-form-wrapper>
            <div class="space-y-4">
                <h2 class="text-3xl mb-2">Contact Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Phone No.<x-required /></label>
                        <input type="text" name="phone_no" id="phone_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="phone_no" />
                        <div class="text-red-600">
                            @error('phone_no')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='changeUserPhone'>Save Changes</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Email<x-required /></label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="email" />
                        <div class="text-red-600">
                            @error('email')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='changeUserEmail'>Save Changes</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="telephone_no" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Telephone<x-required /></label>
                        <input type="text" name="telephone_no" id="telephone_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                            placeholder="ex. Juan" required wire:model="telephone_no" />
                        <div class="text-red-600">
                            @error('telephone_no')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='saveChangesTelephone'>Save Changes</button>
                </div>
            </div>
        </x-form-wrapper>
        @if ($user->role === $HM_ROLE)
            <x-form-wrapper>
                <div>
                    <div class="space-y-4">
                        <h2 class="text-3xl mb-2">Address</h2>
                        @if ($address)
                            <p>{{ $address->street }}, {{ $address->barangay }}, {{ $address->city }}
                                {{ $address->province }}</p>
                        @else
                            <p>No Address Yet</p>
                        @endif
                        <div>
                            <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">
                                House No./Street <x-required />
                            </label>
                            <input type="text" name="street" id="street"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                                required wire:model="street" />
                            @error('street')
                                <div class="text-red-600">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <label for="provinces"
                            class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Province<x-required /></label>
                        <select id="provinces"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            wire:model="province">
                            <option selected value="">Select a Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}">{{ $province }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <div class="text-red-600">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <label for="municipalities"
                            class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">City<x-required /></label>
                        <select id="municipalities"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            wire:model="city">
                            <option selected>Select a Municipality</option>
                        </select>
                        @error('city')
                            <div class="text-red-600">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <label for="barangays"
                            class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Barangay<x-required /></label>
                        <select id="barangays"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            wire:model="barangay">
                            <option selected value="">Select a Barangay</option>
                        </select>
                        @error('barangay')
                            <div class="text-red-600">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='saveAddress'>{{ $this->address ? 'Save Changes' : 'Save' }}</button>
                </div>

            </x-form-wrapper>
        @endif
        <x-form-wrapper>
            <div>
                <h2 class="text-3xl mb-2">Change Password</h2>
                <div class="space-y-4">
                    <div>
                        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Old
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="old_password"
                                wire:model="old_password" id="old_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button tabindex="-1" class="absolute top-0 right-0 bottom-0 me-2"
                                wire:click.prevent="toggleShowPassword">
                                @if ($showPassword)
                                    <i class="fa-solid fa-eye-slash"></i>
                                @else
                                    <i class="fa-solid fa-eye "></i>
                                @endif
                            </button>
                        </div>
                        @error('old_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>
                    <div>
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="new_password"
                                wire:model="new_password" id="new_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button tabindex="-1" class="absolute top-0 right-0 bottom-0 me-2"
                                wire:click.prevent="toggleShowPassword">
                                @if ($showPassword)
                                    <i class="fa-solid fa-eye-slash"></i>
                                @else
                                    <i class="fa-solid fa-eye "></i>
                                @endif
                            </button>
                        </div>
                        @error('new_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm New
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="confirm_password"
                                wire:model="confirm_password" id="confirm_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button tabindex="-1" class="absolute top-0 right-0 bottom-0 me-2"
                                wire:click.prevent="toggleShowPassword">
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
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='changePassword'>Change Password</button>
                </div>
            </div>
        </x-form-wrapper>
    </div>
</div>
