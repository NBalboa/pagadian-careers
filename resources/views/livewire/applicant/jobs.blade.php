<div class="mx-2">
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

            <div class="w-full md:w-1/4">
                <select wire:model.live="job_type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected value="">Type</option>
                    <option value="{{ $JOB_PERMANENT + 1 }}">{{ $this->getJobType($JOB_PERMANENT) }}</option>
                    <option value="{{ $JOB_PART_TIME + 1 }}">{{ $this->getJobType($JOB_PART_TIME) }}</option>
                    <option value="{{ $JOB_FULL_TIME + 1 }}">{{ $this->getJobType($JOB_FULL_TIME) }}</option>
                    <option value="{{ $JOB_CONTRACTUAL + 1 }}">{{ $this->getJobType($JOB_CONTRACTUAL) }}</option>
                </select>
            </div>
            <div class="w-full md:w-1/4">
                <select wire:model.live="job_setup"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected value="">Set Up</option>
                    <option value="{{ $JOB_ON_SITE + 1 }}">{{ $this->getJobSetup($JOB_ON_SITE) }}</option>
                    <option value="{{ $JOB_REMOTE + 1 }}">{{ $this->getJobSetup($JOB_REMOTE) }}</option>
                    <option value="{{ $JOB_HYBRID + 1 }}">{{ $this->getJobSetup($JOB_HYBRID) }}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="text-center w-full" wire:loading>
        <x-loading />

    </div>

    @if (count($recommendations) > 0)
        @foreach ($recommendations as $recommendation)
            <div
                class="group mx-2 mt-10 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto">
                <a href="#"
                    class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4">
                    <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $recommendation['job']->hiring_manager->company->profile) }}"
                            alt="" class="h-full w-full object-cover text-gray-700" />
                    </div>
                </a>
                <div class="col-span-11 flex flex-col pr-8 text-left sm:pl-4">
                    <h3 class="text-sm text-gray-600">{{ $recommendation['job']->hiring_manager->company->name }}</h3>
                    <a href="#" class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl">
                        {{ $recommendation['job']->job_title }}
                        <span class="font-normal text-sm">
                            ({{ $recommendation['job']->hiring_manager->company->address->street }},
                            {{ $recommendation['job']->hiring_manager->company->address->barangay }},
                            {{ $recommendation['job']->hiring_manager->company->address->city }},
                            {{ $recommendation['job']->hiring_manager->company->address->province }})
                        </span>
                    </a>
                    <p class="overflow-hidden pr-7 text-sm">
                        {{ $recommendation['job']->description }}
                    </p>

                    <div
                        class="mt-5 flex flex-col space-y-3 text-sm font-medium text-gray-500 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2">
                        <div>Score:<span
                                class="block text-center rounded-full bg-orange-100 px-2 py-0.5 text-green-900">
                                {{ $recommendation['score'] }}%
                            </span>
                        </div>
                        <div>Experience Required:<span
                                class="block text-center rounded-full bg-green-100 px-2 py-0.5 text-green-900">
                                {{ $recommendation['job']->experience }}
                                {{ $recommendation['job']->experience > 1 ? 'Years' : 'Year' }}
                            </span>
                        </div>
                        @if ($recommendation['job']->show_salary === 1 && $recommendation['job']->salary !== null)
                            <div>Salary:<span
                                    class="block text-center rounded-full bg-blue-100 px-2 py-0.5 text-blue-900">{{ $recommendation['job']->salary }}</span>
                            </div>
                        @endif

                        <div>Job Type:
                            <span
                                class="block text-center text-center rounded-full bg-yellow-100 px-2 py-0.5 text-green-900">
                                {{ $this->getJobType($recommendation['job']->job_type) }}
                            </span>
                        </div>

                        <div>Job Setup:
                            <span
                                class="block text-center text-center rounded-full bg-purple-100 px-2 py-0.5 text-green-900">
                                {{ $this->getJobSetup($recommendation['job']->job_setup) }}
                            </span>
                        </div>
                        <a href="/jobs/{{ $recommendation['job']->id }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex items-center justify-center my-10">
            {{ $recommendations->links() }}
        </div>
    @else
        @if (count($jobs) > 0)
            @foreach ($jobs as $job)
                <div
                    class="group mx-2 mt-10 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto">
                    <a href="#"
                        class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4">
                        <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $job->hiring_manager->company->profile) }}" alt=""
                                class="h-full w-full object-cover text-gray-700" />
                        </div>
                    </a>
                    <div class="col-span-11 flex flex-col pr-8 text-left sm:pl-4">
                        <h3 class="text-sm text-gray-600">{{ $job->hiring_manager->company->name }}</h3>
                        <a href="#" class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl">
                            {{ $job->job_title }}
                            <span class="font-normal text-sm">
                                ({{ $job->hiring_manager->company->address->street }},
                                {{ $job->hiring_manager->company->address->barangay }},
                                {{ $job->hiring_manager->company->address->city }},
                                {{ $job->hiring_manager->company->address->province }})
                            </span>
                        </a>
                        <p class="overflow-hidden pr-7 text-sm">
                            {{ $job->description }}
                        </p>

                        <div
                            class="mt-5 flex flex-col space-y-3 text-sm font-medium text-gray-500 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2">
                            <div>Required Experience:
                                <span class="block text-center rounded-full bg-green-100 px-2 py-0.5 text-green-900">
                                    {{ $job->experience }} {{ $job->experience > 1 ? 'Years' : 'Year' }}
                                </span>
                            </div>
                            @if ($job->show_salary === 1 && $job->salary !== null)
                                <div class="">Salary:<span
                                        class="block text-center rounded-full bg-blue-100 px-2 py-0.5 text-blue-900">{{ $job->salary }}
                                        day</span>
                                </div>
                            @endif

                            <div>Job Type:
                                <span class="block text-center rounded-full bg-yellow-100 px-2 py-0.5 text-green-900">
                                    {{ $this->getJobType($job->job_type) }}
                                </span>
                            </div>

                            <div>Job Setup:
                                <span class="block text-center rounded-full bg-purple-100 px-2 py-0.5 text-green-900">
                                    {{ $this->getJobSetup($job->job_setup) }}
                                </span>
                            </div>
                            <a href="/jobs/{{ $job->id }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex items-center justify-center my-10">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="flex items-center justify-center my-10">No Jobs Found</div>
        @endif
    @endif
</div>
