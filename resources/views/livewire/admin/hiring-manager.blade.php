<div>
    <h2 class="text-3xl mb-2">List of Hiring Managers</h2>

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
                    placeholder="" required />
                <button type="submit" wire:click="searchJobs"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="company_search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Companies</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (session('success'))
        <h3 class="text-green-400 text-center pt-2 pb-2">{{ session('success') }}</h3>
    @endif
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Name</x-table-header-item>
            <x-table-header-item>Company</x-table-header-item>
            <x-table-header-item>Email</x-table-header-item>
            <x-table-header-item>Contact No.</x-table-header-item>
            <x-table-header-item>Telephone No.</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($hiring_managers as $hiring_manager)
                <x-table-row>
                    <x-table-row-item isClickable={{ true }}
                        function="goToEditHiringManager({{ $hiring_manager->id }})">
                        {{ $hiring_manager->user->first_name }}
                        {{ $hiring_manager->user->last_name }}
                    </x-table-row-item>
                    <x-table-row-item isClickable={{ true }}
                        function="goToEditCompany({{ $hiring_manager->company->id }})">
                        {{ $hiring_manager->company->name }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->email }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->phone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->telephone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ mb_strtolower($hiring_manager->address->street) }},
                        {{ mb_strtolower($hiring_manager->address->barangay) }},
                        {{ mb_strtolower($hiring_manager->address->city) }},
                        {{ mb_strtolower($hiring_manager->address->province) }}
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>
    <a href="/hiringmanager/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Hiring Manager
    </a>
</div>
