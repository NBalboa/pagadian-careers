<div>
    <div class="px-14">
        <div class="h-svh flex flex-col items-center justify-between md:flex-row gap-2">
            <div class="pt-14 md:pt-5 sm:w-full md:w-1/2">
                <div>
                    <h1 class="text-5xl font-bold mb-2 md:text-7xl">Find your dream jobs
                        with <span class="text-blue-600 font-bolder">Pagadian Careers</span>
                    </h1>
                    <p class="text-md md:text-lg font-semibold text-gray-700">
                        Find jobs and enrich your applications, carefully crafted analyzing the
                        needs of
                        different
                        industries
                    </p>

                    <div class="mt-5">
                        <a href="/jobs"
                            class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2  focus:outline-none">
                            Find Jobs
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-full  mix-blend-color">
                <img class="w-full h-full" src="{{ asset('images/process-02.png') }}" alt="landing image" />
            </div>
        </div>
        <div class="mt-[100px] mb-5">
            <h2 class="text-center text-gray-600 text-4xl font-bold md:text-5xl">Jobs</h2>

            <form class="max-w-lg mx-auto my-[20px]" wire:submit.prevent="setSearch">
                <div class="flex relative">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your
                        Email</label>
                    <button wire:click="setShowDropDown"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                        type="button">{{ $search_company ? Str::limit($search_company->name, 10) : 'All Companies' }}<svg
                            class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdown"
                        class="z-10 {{ $showdropDown ? 'block' : 'hidden' }} absolute top-[50px] bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                            @if ($search_company)
                                <li>
                                    <button type="button" wire:click="setSearchCompany('null')"
                                        class="inline-flex w-full px-4 py-2">All Companies</button>
                                </li>
                            @endif
                            @foreach ($companies as $company)
                                @if ($search_company)
                                    <li>
                                        <button type="button" wire:click="setSearchCompany({{ $company->id }})"
                                            class="inline-flex w-full px-4 py-2 {{ $search_company->id === $company->id ? 'bg-gray-100' : 'hover:bg-gray-100' }} ">{{ $company->name }}</button>
                                    </li>
                                @else
                                    <li>
                                        <button type="button" wire:click="setSearchCompany({{ $company->id }})"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">{{ $company->name }}</button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" wire:model.live="search"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="" required />
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-4">
                <div class="shadow-xl rounded">
                    <div class="flex flex-col gap-5 justify-center md:gap-0 md:flex-row py-2">
                        <button wire:click="changeChangeFilter('recent')"
                            class="px-5 py-2 rounded text-md
                            {{ $filters['recent']['is_active'] ? 'bg-blue-600 text-white hover:opacity-80' : 'text-gray-500 hover:text-blue-500' }}
                            font-semibold">Recent</button>
                        <button wire:click="changeChangeFilter('permanent')"
                            class="px-5 py-2 rounded text-md {{ $filters['permanent']['is_active'] ? 'bg-blue-600 text-white hover:opacity-80' : 'text-gray-500 hover:text-blue-500' }} font-semibold">Permanent</button>
                        <button wire:click="changeChangeFilter('part-time')"
                            class="px-5 py-2 rounded text-md {{ $filters['part-time']['is_active'] ? 'bg-blue-600 text-white hover:opacity-80' : 'text-gray-500 hover:text-blue-500' }} font-semibold">Part-Time</button>
                        <button wire:click="changeChangeFilter('full-time')"
                            class="px-5 py-2 rounded text-md {{ $filters['full-time']['is_active'] ? 'bg-blue-600 text-white hover:opacity-80' : 'text-gray-500 hover:text-blue-500' }} font-semibold">Full-Time</button>
                        <button wire:click="changeChangeFilter('contractual')"
                            class="px-5 py-2 rounded text-md {{ $filters['contractual']['is_active'] ? 'bg-blue-600 text-white hover:opacity-80' : 'text-gray-500 hover:text-blue-500' }} font-semibold">Contractual</button>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                @if ($jobs->count() > 0)
                    @foreach ($jobs as $job)
                        <div
                            class="group mx-2 mt-10 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto">
                            <a href="/jobs/{{ $job->id }}"
                                class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4">
                                <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                                    <img src="{{ asset('storage/' . $job->hiring_manager->company->profile) }}"
                                        alt="" class="h-full w-full object-cover text-gray-700" />
                                </div>
                            </a>
                            <div class="col-span-11 flex flex-col pr-8 text-left sm:pl-4">
                                <h3 class="text-sm text-gray-600">{{ $job->hiring_manager->company->name }}</h3>
                                <a href="/jobs/{{ $job->id }}"
                                    class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl">
                                    {{ $job->job_title }}
                                    <span class="font-normal text-sm">
                                        ({{ $job->hiring_manager->company->address->street }},
                                        {{ $job->hiring_manager->company->address->barangay }},
                                        {{ $job->hiring_manager->company->address->city }},
                                        {{ $job->hiring_manager->company->address->province }})
                                    </span>
                                </a>

                                <div class="overflow-hidden">
                                    <p class="pr-7 text-sm">
                                        {{ $job->description }}
                                    </p>

                                    <h2 class="text-black mt-5 font-medium">Hiring Information</h2>

                                    <div
                                        class="flex flex-col space-y-3 text-sm font-medium text-gray-500 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2">

                                        <div>Applicants:
                                            <span class="block text-center px-2 py-0.5 text-bold text-black">
                                                {{ $job->max_applicants_hired }}
                                            </span>
                                        </div>
                                        <div>Starts:
                                            <span class="block text-center px-2 py-0.5 text-bold text-black">
                                                {{ $this->formatDate($job->start_hiring) }}
                                            </span>
                                        </div>
                                        <div>Ends:
                                            <span class="block text-center px-2 py-0.5 text-bold text-black">
                                                {{ $this->formatDate($job->end_hiring) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-5 flex flex-col space-y-3 text-sm font-medium text-gray-500 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2">
                                    <div>Required Experience:
                                        <span
                                            class="block text-center rounded-full bg-green-100 px-2 py-0.5 text-green-900">
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
                                        <span
                                            class="block text-center rounded-full bg-yellow-100 px-2 py-0.5 text-green-900">
                                            {{ $this->getJobType($job->job_type) }}
                                        </span>
                                    </div>

                                    <div>Job Setup:
                                        <span
                                            class="block text-center rounded-full bg-purple-100 px-2 py-0.5 text-green-900">
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
                @else
                    <div class="flex items-center justify-center my-10">No Jobs Found</div>
                @endif
            </div>

            <div class="flex items-center justify-center mt-5">
                <a href="/jobs"
                    class="px-4 py-2 text-md font-semibold rounded bg-blue-600 text-white hover:opacity-80">View
                    More</a>
            </div>
        </div>
        <div class="mt-[100px] mb-5">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-600">How it Works</h2>
            <div class="mt-5 ms-5 flex flex-col gap-5">
                <div class="flex gap-10">
                    <div class="flex items-center justify-center rounded-full bg-gray-300 h-[50px] w-[50px]">
                        <p class="text-lg font-bold block align-middle">1</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="text-2xl font-bold text-gray-500 block align-middle">Register an account</p>
                    </div>
                </div>
                <div class="flex gap-10">
                    <div class="flex items-center justify-center rounded-full bg-gray-300 h-[50px] w-[50px]">
                        <p class="text-lg font-bold block align-middle">2</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="text-2xl font-bold text-gray-500 block align-middle">Find your job</p>
                    </div>
                </div>
                <div class="flex gap-10">
                    <div class="flex items-center justify-center rounded-full bg-gray-300 h-[50px] w-[50px]">
                        <p class="text-lg font-bold block align-middle">3</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="text-2xl font-bold text-gray-500 block align-middle">Apply for job</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[100px]  mb-5">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-600">FAQs</h2>

            @foreach ($FAQs as $index => $FAQ)
                @if ($index === 0)
                    <div id="accordion-color" data-accordion="collapse" class="mt-5"
                        data-active-classes="bg-blue-100 text-blue-600">
                        <h2>
                            <button type="button" wire:click="showAccordion({{ $index }})"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 hover:bg-blue-100 gap-3"
                                data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                                aria-controls="accordion-color-body-1">
                                <span>{{ $FAQ['title'] }}</span>
                                <svg data-accordion-icon
                                    class="w-3 h-3 {{ $FAQ['show'] ? 'rotate-360' : 'rotate-180' }} shrink-0"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div class="{{ $FAQ['show'] ? 'block' : 'hidden' }}"
                            aria-labelledby="accordion-color-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200">
                                <p class="mb-2 text-gray-500">{{ $FAQ['content'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @elseif (count($FAQs) - 1 === $index)
                    <div id="accordion-color" data-accordion="collapse"
                        data-active-classes="bg-blue-100 text-blue-600">
                        <h2>
                            <button type="button" wire:click="showAccordion({{ $index }})"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-100 gap-3"
                                data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                                aria-controls="accordion-color-body-1">
                                <span>{{ $FAQ['title'] }}</span>
                                <svg data-accordion-icon
                                    class="w-3 h-3 {{ $FAQ['show'] ? 'rotate-360' : 'rotate-180' }} shrink-0"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div class="{{ $FAQ['show'] ? 'block' : 'hidden' }}"
                            aria-labelledby="accordion-color-heading-1">
                            <div class="p-5 border border-b border-gray-200">
                                <p class="mb-2 text-gray-500">{{ $FAQ['content'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div id="accordion-color" data-accordion="collapse"
                        data-active-classes="bg-blue-100 text-blue-600">
                        <h2>
                            <button type="button" wire:click="showAccordion({{ $index }})"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-100 gap-3"
                                data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                                aria-controls="accordion-color-body-1">
                                <span>{{ $FAQ['title'] }}</span>
                                <svg data-accordion-icon
                                    class="w-3 h-3 {{ $FAQ['show'] ? 'rotate-360' : 'rotate-180' }} shrink-0"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div class="{{ $FAQ['show'] ? 'block' : 'hidden' }}"
                            aria-labelledby="accordion-color-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200">
                                <p class="mb-2 text-gray-500">{{ $FAQ['content'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="mt-5">
        <div class="bg-gray-100 rounded-t-3xl p-5">
            <h2 class="text-center text-2xl md:text-4xl text-gray-700 font-bold">Browse more than <span
                    class="text-blue-600">100+</span> Latest Jobs</h2>
        </div>
    </div>
</div>
