<div>
    <div class="mb-10 mx-2">
        <a href="/my/job" wire:navigate
            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Back</a>

        <a href="/my/job/edit/{{ $job->id }}" wire:navigate
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</a>
    </div>
    <div
        class="mb-10 group mx-2 mt-10 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto">
        <a href="#"
            class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4 cursor-auto">
            <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $company->profile) }}" alt=""
                    class="h-full w-full object-cover text-gray-700" />
            </div>
        </a>
        <div class="col-span-11 flex flex-col pr-8 text-left sm:pl-4">
            <h3 class="text-sm text-gray-600">{{ $company->name }}</h3>
            <a href="#" class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl cursor-auto">
                {{ $job->job_title }}
                <span class="font-normal text-sm block">
                    ({{ $address->street }},
                    {{ $address->barangay }},
                    {{ $address->city }},
                    {{ $address->province }})
                </span>
            </a>
            <div class="overflow-hidden">
                <p class="pr-7 text-sm">
                    {{ $job->description }}
                </p>
                <h2 class="text-black mt-5 font-medium">Contacts</h2>
                <div class="flex flex-col flex-wrap text-sm font-medium text-gray-500">
                    <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                        {{ $user->email }}
                    </p>
                    <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                        {{ $user->phone_no }}
                    </p>
                    @if ($user->telephone_no)
                        <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                            {{ $user->telephone_no }}
                        </p>
                    @endif
                </div>
                <h2 class="text-black mt-5 font-medium">Responsibilities</h2>
                <div class="flex flex-col flex-wrap text-sm font-medium text-gray-500">
                    @foreach ($responsibilities as $responsibility)
                        <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                            {{ $responsibility->description }}
                        </p>
                    @endforeach
                </div>

                <h2 class="text-black mt-5 font-medium">Qualifications</h2>
                <div class="flex flex-col flex-wrap text-sm font-medium text-gray-500">
                    @foreach ($qualifications as $qualification)
                        <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                            {{ $qualification->description }}
                        </p>
                    @endforeach
                </div>
                <h2 class="text-black mt-5 font-medium">Skills</h2>
                <div class="flex flex-col flex-wrap text-sm font-medium text-gray-500">
                    @foreach ($skills as $skill)
                        <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                            {{ $skill['name'] }}
                        </p>
                    @endforeach
                </div>
                <h2 class="text-black mt-5 font-medium">Educations</h2>
                <div class="flex flex-col flex-wrap text-sm font-medium text-gray-500">
                    @foreach ($educations as $index => $education)
                        <p class="block px-2 py-0.5 text-bold font-medium text-gray-500">
                            {{ $education['name'] }}
                        </p>
                    @endforeach
                </div>
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
            </div>
        </div>
    </div>
</div>
