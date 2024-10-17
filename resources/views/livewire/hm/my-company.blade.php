<div>
    <h2 class="text-3xl mb-2">Edit Company</h2>
    @if (session('success'))
        <h3 class="text-green-400 text-center pt-2 pb-2">{{ session('success') }}</h3>
    @endif
    @if ($company_profile)
        <div class="rounded-full overflow-hidden h-32 w-32 border border-4 border-gray-500 mb-2">
            <img src="{{ asset('storage/' . $company_profile) }}" alt="sample image" class="object-cover">
        </div>
    @endif
    <div>
        <h6 class="text-2xl mb-2 mt-2">Logo</h6>
        <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload
            Logo <x-required /> </label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   "
            id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" wire:model="profile">
        @error('profile')
            <div class="text-red-600">
                <span>{{ $message }}</span>
            </div>
        @enderror
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2"
            wire:click='changeLogo'>Save</button>
    </div>

    <div>
        <h6 class="text-2xl mb-2 mt-2">Company Details</h6>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                Name<x-required /></label>
            <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Juan" required wire:model="name" />
            <div class="text-red-600">
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="url" class="block mb-2 text-sm font-medium text-gray-900 ">
                Url</label>
            <input type="text" name="url" id="url"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="url" />
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                Description</label>
            <textarea id="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  "
                wire:model="description"></textarea>
            @error('description')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2"
            wire:click='changeCompanyDetails'>Save</button>
    </div>
    <div>
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
        <label for="provinces" class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Province<x-required /></label>
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
        <label for="barangays" class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Barangay<x-required /></label>
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

        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2"
            wire:click='changeAddress'>Save</button>
    </div>
</div>
