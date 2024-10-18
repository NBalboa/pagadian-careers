<div>
    <h2 class="text-3xl mb-2">List of Jobs
        <div role="status" wire:loading>
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </h2>
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
                    placeholder="" required />
                <button type="submit" wire:click="searchJob"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="job_setup"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Setup</option>
                <option value="{{ $JOB_ON_SITE }}">On-Site</option>
                <option value="{{ $JOB_REMOTE }}">Remote</option>
                <option value="{{ $JOB_HYBRID }}">Hybrid</option>
            </select>
        </div>

        <div class="w-full md:w-1/4">
            <select wire:model.live="job_type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Type</option>
                <option value="{{ $JOB_PERMANENT }}">Permanent</option>
                <option value="{{ $JOB_PART_TIME }}">Part-Time</option>
                <option value="{{ $JOB_FULL_TIME }}">Full-Time</option>
                <option value="{{ $JOB_CONTRACTUAL }}">Contractual</option>
            </select>
        </div>

    </div>
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Title</x-table-header-item>
            <x-table-header-item>Setup</x-table-header-item>
            <x-table-header-item>Type</x-table-header-item>
            <x-table-header-item>Salary</x-table-header-item>
            <x-table-header-item>No. of Applicants</x-table-header-item>
            <x-table-header-item>Is Closed?</x-table-header-item>
            <x-table-header-item>Applicants</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($jobs as $job)
                <x-table-row class="cursor-pointer">
                    <x-table-row-item isClickable={{ true }}
                        function="goToJobPreview({{ $job->id }})">{{ $job->job_title }}</x-table-row-item>
                    <x-table-row-item>{{ $this->getJobSetup($job->job_setup) }}</x-table-row-item>
                    <x-table-row-item>{{ $this->getJobType($job->job_type) }}</x-table-row-item>
                    <x-table-row-item>{{ $job->salary }}</x-table-row-item>
                    <x-table-row-item>{{ $this->getTotalApplicants($job) }}</x-table-row-item>
                    <x-table-row-item>
                        <div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="JobIsClosedIds.{{ $job->id }}"
                                    wire:click="isCloseJob({{ $job->id }})" class="sr-only peer"
                                    wire:loading.attr="disabled">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                    </x-table-row-item>
                    <x-table-row-item>

                        @if ($this->getTotalApplicants($job) > 0)
                            <a href="/my/job/{{ $job->id }}/applicants"
                                class="font-medium text-green-600  hover:underline">Details</a>
                        @endif
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>

    <a href="/my/job/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Job
    </a>
</div>
