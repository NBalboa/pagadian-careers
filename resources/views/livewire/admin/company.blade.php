<div>
    <h2 class="text-3xl mb-2">List of Companies</h2>
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
    </div>
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Name</x-table-header-item>
            <x-table-header-item>Url</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($companies as $company)
                <x-table-row>
                    <x-table-row-item>{{ $company->name }}</x-table-row-item>
                    <x-table-row-item>{{ $company->url }}</x-table-row-item>
                    <x-table-row-item>
                        {{ mb_strtolower($company->address->street) }},
                        {{ mb_strtolower($company->address->barangay) }},
                        {{ mb_strtolower($company->address->city) }},
                        {{ mb_strtolower($company->address->province) }}
                    </x-table-row-item>
                    <x-table-row-item>
                        <a href="company/edit/{{ $company->id }}"
                            class="font-medium text-blue-600  hover:underline">Edit</a>
                        <button class="font-medium text-red-600  hover:underline"
                            wire:click="delete({{ $company->id }})"
                            wire:confirm="Are you sure about that?">Delete</button>
                    </x-table-row-item>
                </x-table-row>
            @endforeach

        </tbody>
    </x-table-layout>
    <a href="/company/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Company
    </a>
</div>
