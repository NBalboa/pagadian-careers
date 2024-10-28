<div>
    <div class="mb-2">
        <a href="/my/job/"
            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-1/4">Back</a>
    </div>
    <h2 class="text-3xl mb-2">Applicants ({{ $job->job_title }})
        <span wire:loading wire:target="save">
            <x-loading />
        </span>
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
                <button type="submit" wire:click="searchJobs"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>

        <div class="w-full md:w-1/4">
            <select wire:model.live="gender"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Gender</option>
                <option value="{{ $MALE }}">Male</option>
                <option value="{{ $FEMALE }}">Female</option>
            </select>
        </div>
        <div class="w-full md:w-1/4">
            <select wire:model.live="job_status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected value="">Status</option>
                <option value="{{ $JOB_PENDING }}">Pending</option>
                <option value="{{ $JOB_INTERVIEW }}">Interview</option>
                <option value="{{ $JOB_HIRED }}">Hired</option>
                <option value="{{ $JOB_REJECTED }}">Rejected</option>
            </select>
        </div>
    </div>

    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Applicant Name</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
            <x-table-header-item>Contacts</x-table-header-item>
            <x-table-header-item>Gender</x-table-header-item>
            <x-table-header-item>Status</x-table-header-item>
            <x-table-header-item>Remarks</x-table-header-item>
            <x-table-header-item>Score</x-table-header-item>
            <x-table-header-item>Rank</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($applicants as $applicant)
                <x-table-row>
                    <x-table-row-item isClickable={{ true }}
                        function="goToApplicantProfile({{ $job->id }}, {{ $applicant['applicant']->id }})">
                        {{ $applicant['applicant']->user->last_name }},
                        {{ $applicant['applicant']->user->first_name }}</x-table-row-item>
                    @if (!$applicant['applicant']->address)
                        <x-table-row-item>No Address</x-table-row-item>
                    @else
                        <x-table-row-item>
                            {{ $applicant['applicant']->address->street }},
                            <br />
                            {{ $applicant['applicant']->address->barangay }},
                            <br />
                            {{ $applicant['applicant']->address->city }},
                            <br />
                            {{ $applicant['applicant']->address->province }}
                        </x-table-row-item>
                    @endif
                    <x-table-row-item>
                        email: {{ $applicant['applicant']->user->email }}
                        <br>
                        phone: {{ $applicant['applicant']->user->phone_no }}
                        @if ($applicant['applicant']->user->telephone_no)
                            <br>
                            Telephone: {{ $applicant['applicant']->user->telephone_no }}
                        @endif
                    </x-table-row-item>
                    <x-table-row-item>{{ $this->getGender($applicant['applicant']->gender) }}</x-table-row-item>
                    <x-table-row-item>
                        <select id="applicant_status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-[8px] focus:ring-blue-500 focus:border-blue-500 block w-full py-0.5"
                            wire:model= "statuses.{{ $applicant['applicant']->id }}">
                            <option value="{{ $JOB_PENDING }}">PENDING</option>
                            <option value="{{ $JOB_INTERVIEW }}">INTERVIEW</option>
                            <option value="{{ $JOB_HIRED }}">HIRED</option>
                            <option value="{{ $JOB_REJECTED }}">REJECTED</option>
                        </select>
                    </x-table-row-item>
                    <x-table-row-item>
                        <textarea
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            wire:model="remarks.{{ $applicant['applicant']->id }}"></textarea>
                    </x-table-row-item>
                    <x-table-row-item>{{ $applicant['score']['total'] }}%</x-table-row-item>
                    <x-table-row-item>{{ $applicant['rank'] }}</x-table-row-item>
                    <x-table-row-item>
                        <div class="flex flex-row gap-x-4 items-center">
                            <button wire:click="save({{ $applicant['applicant']->id }})"
                                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-auto">
                                Save
                            </button>
                        </div>
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>
    @if ($applicants->links())
        <div class="mt-5">
            {{ $applicants->links('pagination::tailwind') }}
        </div>
    @endif
</div>
