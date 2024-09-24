<div>
    <h1 class="font-bold text-2xl mx-5 mt-2">My Jobs</h1>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 sm:px-8">
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
                <p class="text-3xl">12,768</p>
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
                <p class="text-3xl">12,768</p>
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
                <p class="text-3xl">12,768</p>
            </div>
        </div>
    </div>
    <div class="m-4">
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
