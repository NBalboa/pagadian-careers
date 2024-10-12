<div>
    <h1 class="font-bold text-2xl mx-5 mt-2">My Jobs</h1>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 sm:px-8">
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Pending</h3>
                <p class="text-3xl">{{ $this->total_pending }}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Interview</h3>
                <p class="text-3xl">{{ $this->total_interview }}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Rejected</h3>
                <p class="text-3xl">{{ $this->total_rejected }}</p>
            </div>
        </div>

        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
            <div class="p-4 bg-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Hired</h3>
                <p class="text-3xl">{{ $this->total_hired }}</p>
            </div>
        </div>
    </div>



    <div class="m-4">
        <div class="flex flex-col md:flex-row mx-auto gap-2 justify-center items-center mb-2">
            <div class="w-full md:w-1/2">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
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
                    <option value="company">Company</option>
                </select>
            </div>
            <div class="w-full md:w-1/4">
                <select wire:model.live="job_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected value="">Status</option>
                    <option value="1">Pending</option>
                    <option value="2">Interview</option>
                    <option value="3">Hired</option>
                    <option value="4">Rejected</option>
                </select>
            </div>
        </div>

        <x-table-layout>
            <x-table-header>
                <x-table-header-item>Job Title</x-table-header-item>
                <x-table-header-item>Company Name</x-table-header-item>
                <x-table-header-item>Address</x-table-header-item>
                <x-table-header-item>Status</x-table-header-item>
                <x-table-header-item>Remarks</x-table-header-item>
            </x-table-header>
            <tbody>
                @foreach ($jobs as $job)
                    <x-table-row>
                        <x-table-row-item>{{ $job->job_title }}</x-table-row-item>
                        <x-table-row-item>{{ $job->hiring_manager->company->name }}</x-table-row-item>
                        <x-table-row-item>
                            {{ $job->hiring_manager->company->address->street }},
                            {{ $job->hiring_manager->company->address->barangay }},
                            {{ $job->hiring_manager->company->address->city }},
                            {{ $job->hiring_manager->company->address->province }}
                        </x-table-row-item>
                        <x-table-row-item>{{ $this->applicantJobStatus($job->pivot->status) }}</x-table-row-item>
                        <x-table-row-item>{{ $job->pivot->remarks }}</x-table-row-item>
                    </x-table-row>
                @endforeach
            </tbody>
        </x-table-layout>
    </div>
</div>
