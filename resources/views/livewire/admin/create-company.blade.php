    <div class="p-4 md:p-5">
        @error('error')
            <div>{{ $message }}</div>
        @enderror
        <h2 class="text-3xl mb-2">Create Company</h2>
        <div class="space-y-4">
            <div>
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
            </div>
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
        </div>
        <h6 class="text-2xl mb-2 mt-2">Address</h6>

        <div <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">
            House No./Street<x-required />
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
            class="w-full text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            wire:click='save'>Create</button>
    </div>
