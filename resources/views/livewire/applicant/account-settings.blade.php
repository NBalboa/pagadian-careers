<div>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <x-back to="/my/profile" />

        <x-form-wrapper>
            <h2 class="text-3xl mb-2">Account Information</h2>
            <div class="space-y-4">
                <div>
                    @if ($image)
                        <div class="rounded-full overflow-hidden h-32 w-32 mx-auto border border-4 border-gray-500">
                            <img src="{{ $image->temporaryUrl() }}" alt="sample image" class="object-cover">
                        </div>
                    @else
                        <div class="rounded-full overflow-hidden h-32 w-32 mx-auto border border-4 border-gray-500 ">
                            <img src="{{ asset('storage/' . $applicant->profile) }}" alt="sample image"
                                class="object-cover">
                        </div>
                    @endif
                </div>
                @if ($applicant->resume)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $applicant->resume) }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Resume</a>
                    </div>
                @endif
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Change
                        Profile Picture<x-required /> </label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   "
                        id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" wire:model="image">
                    @error('image')
                        <div class="text-red-600">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Resume</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   "
                        type="file" accept=".pdf" wire:model="resume">
                    @error('resume')
                        <div class="text-red-600">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
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

                <div>
                    <label for="gender"
                        class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Gender<x-required /></label>
                    <select id="gender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        wire:model="gender">
                        <option selected value="">Select Gender</option>
                        <option value="0">MALE</option>
                        <option value="1">FEMALE</option>
                    </select>
                    @error('gender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="edu_attainment" class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Education
                        Attainment<x-required /></label>
                    <select id="edu_attainment"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        wire:model="edu_attainment">
                        <option selected value="">Select Education Attainment</option>
                        <option value="0">Elementary Graduate</option>
                        <option value="1">High School Graduate</option>
                        <option value="2">Associate Degree</option>
                        <option value="3">Bachelor's Degree</option>
                        <option value="4">Master's Degree</option>
                        <option value="5">Doctorate Degree</option>
                    </select>
                    @error('edu_attainment')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
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

        <div>
            <x-form-wrapper>
                <div class="space-y-4">
                    <h2 class="text-3xl mb-2">Address</h2>
                    @if ($address)
                        <p>{{ $address->street }}, {{ $address->barangay }}, {{ $address->city }}
                            {{ $address->province }}</p>
                    @else
                        <p>No Address Yet</p>
                    @endif
                    <div>
                        <label for="street" class="block mb-2 text-sm font-medium text-gray-900">
                            House No./Street <x-required /> </label>
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
            </x-form-wrapper>
        </div>
        <div>
            <x-form-wrapper>
                <h2 class="text-3xl mb-2">Others</h2>
                <div class="space-y-4">
                    <div>
                        <label for="about" class="block mb-2 text-sm font-medium text-gray-900 ">
                            About</label>
                        <textarea id="about" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  "
                            wire:model="about"></textarea>
                        @error('about')
                            <div class="text-red-600">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <button
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='saveAbout'>{{ $this->about ? 'Save Changes' : 'Save' }}</button>
                </div>
            </x-form-wrapper>
        </div>
        <div>
            <x-form-wrapper>
                <h2 class="text-3xl mb-2">Change Password</h2>
                <div class="space-y-4">
                    <div>
                        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="old_password"
                                wire:model="old_password" id="old_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button class="absolute top-0 right-0 bottom-0 me-2"
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
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="new_password"
                                wire:model="new_password" id="new_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button class="absolute top-0 right-0 bottom-0 me-2"
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
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="{{ $showPassword ? 'text' : 'password' }}" name="confirm_password"
                                wire:model="confirm_password" id="confirm_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <button class="absolute top-0 right-0 bottom-0 me-2"
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
            </x-form-wrapper>
        </div>
    </div>
</div>
