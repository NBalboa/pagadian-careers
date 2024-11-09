    <div class="p-4 md:p-5 space-y-5">
        <a href="/hiringmanager" wire:navigate
            class="px-4 py-2 text-md hover:bg-blue-700 bg-blue-600 text-white font-semibold rounded">Back</a>

        <x-form-wrapper>
            <h2 class="text-3xl mb-2">Create Hiring Manager</h2>
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
                        Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Dela" required wire:model="middle_name" />
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Last Name<x-required /></label>
                    <input type="text" name="last_name" id="last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Cruz" required wire:model="last_name" />
                    @error('last_name')
                        <div class="text-red-600">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Email<x-required /></label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. juandelacruz@email.com" required wire:model="email" />
                    @error('email')
                        <div class="text-red-600">

                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Contact No.<x-required /></label>
                    <input type="text" name="phone_no" id="phone_no"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Cruz" required wire:model='phone_no' />
                    @error('phone_no')
                        <div class="text-red-600">
                            <span>{{ $message }}</span>

                        </div>
                    @enderror
                </div>
                <div>
                    <label for="telephone_no" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Telephone No.</label>
                    <input type="text" name="telephone_no" id="telephone_no"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Cruz" required wire:model='telephone_no' />
                </div>
                <label for="company"
                    class="block mb-2 text-sm font-medium text-gray-900 ">Company<x-required /></label>
                <select id="company"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model='company'>
                    <option selected value="">Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('company')
                    <div class="text-red-600">
                        <span>{{ $message }}</span>
                    </div>
                @enderror

            </div>
            <h6 class="text-2xl mb-2 mt-2">Address</h6>
            <div>
                <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">
                    House No./Street<x-required /></label>
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
            <div class="m-2" wire:loading>
                <x-loading />
            </div>
            <button
                class="w-full md:max-w-[200px] text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                wire:click='save'>Create</button>
        </x-form-wrapper>
    </div>
