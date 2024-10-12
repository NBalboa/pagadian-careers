<div>
    <h2 class="text-3xl mb-2">List of Applicants</h2>
    <div class="flex flex-col md:flex-row mx-auto gap-2 justify-center items-center mb-2">
        <div class="w-full md:w-1/2">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" wire:model.live="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search Mockups, Logos..." required />
                <button type="submit" wire:click="searchJobs"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="searchBy"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Search by</option>
                <option value="address">Address</option>
                <option value="verifier">Verifier</option>
            </select>


        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="gender"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Gender</option>
                <option value="0">MALE</option>
                <option value="1">FEMALE</option>

            </select>
        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="verifieds"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">All</option>
                <option value="0">Not</option>
                <option value="1">Verified</option>
            </select>
        </div>
    </div>
    @if (session('success'))
        <h3 class="text-green-400 text-center pt-2 pb-2">{{ session('success') }}</h3>
    @endif
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Name</x-table-header-item>
            <x-table-header-item>Email</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
            <x-table-header-item>Contact No.</x-table-header-item>
            <x-table-header-item>Telephone No.</x-table-header-item>
            <x-table-header-item>Gender</x-table-header-item>
            <x-table-header-item>Verified</x-table-header-item>
            <x-table-header-item>Verified By</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($applicants as $applicant)
                <x-table-row>
                    <x-table-row-item>
                        {{ $applicant->user->first_name }}
                        {{ $applicant->user->last_name }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $applicant->user->email }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ mb_strtolower($applicant->address->street) }},
                        {{ mb_strtolower($applicant->address->barangay) }},
                        {{ mb_strtolower($applicant->address->city) }},
                        {{ mb_strtolower($applicant->address->province) }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $applicant->user->phone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $applicant->user->telephone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $this->getGender($applicant->gender) }}
                    </x-table-row-item>
                    <x-table-row-item>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:click="verifyApplicant({{ $applicant->id }})"
                                wire:model="verified.{{ $applicant->id }}" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $applicant->verifier }}
                    </x-table-row-item>
                    <x-table-row-item>
                        <a href="#" class="font-medium text-blue-600  hover:underline">Profile</a>
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>
</div>
