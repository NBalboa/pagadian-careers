<div>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div>
            <a href="/my/profile/create/experience"
                class="px-4 py-2 rounded bg-blue text-white text-semibold bg-blue-600 text-md">Back</a>
        </div>
        <x-form-wrapper>
            <div class="space-y-4">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Title<x-required /></label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Juan" required wire:model="title" />
                    <div class="text-red-600">
                        @error('title')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Company Name<x-required /></label>
                    <input type="text" name="company_name" id="company_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Juan" required wire:model="company_name" />
                    <div class="text-red-600">
                        @error('company_name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="start" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Start Year</label>
                    <input type="number" name="start" id="start"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        required wire:model="start" />
                    <div class="text-red-600">
                        @error('start')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="end" class="block mb-2 text-sm font-medium text-gray-900 ">
                        End Year</label>
                    <input type="number" name="end" id="end"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        required wire:model="end" />
                    <div class="text-red-600">
                        @error('end')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
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
                    class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    wire:click='saveChangesExperience'>Save Changes</button>
            </div>
        </x-form-wrapper>
    </div>
</div>
