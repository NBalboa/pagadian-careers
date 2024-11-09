<div>
    <a href="/applicants" wire:navigate
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2">Back</a>
    <div class="bg-white">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-gray-100 shadow-xl rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('storage/' . $applicant->profile) }}"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                            </img>
                            <h1 class="text-xl font-bold">
                                {{ ucfirst($applicant->user->first_name) }}
                                {{ ucfirst($applicant->user->last_name) }}
                                @if ($applicant->verified === $VERIFIED_YES)
                                    <span class="text-blue-600">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                @endif
                            </h1>
                            <p class="text-gray-700 hidden">Software Developer</p>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                @if ($applicant->resume)
                                    <a href="{{ asset('storage/' . $applicant->resume) }}" target="_blank"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Resume</a>
                                @endif
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">
                                Contact
                            </span>
                            <ul>
                                <li class="mb-2">
                                    <p class="break-all">
                                        {{ $applicant->user->email }}
                                    </p>
                                </li>
                                <li class="mb-2">
                                    <p class="break-all">
                                        {{ $applicant->user->phone_no }}
                                    </p>
                                </li>
                                @if ($applicant->user->telephone_no)
                                    <li class="mb-2">
                                        <p class="break-all">
                                            {{ $applicant->user->telephone_no }}
                                        </p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @if ($applicant->edu_attainment)
                            <hr class="my-6 border-t border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">
                                    Highest Educational Attainment
                                </span>
                                <ul>
                                    <li class="mb-2 ">
                                        <p class="break-all">{{ $this->getEduAttainment($applicant->edu_attainment) }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">
                                Skills
                            </span>
                            <ul>
                                @foreach ($applicant_skills as $index => $skill)
                                    <li class="mb-2">
                                        <p class="break-all">{{ $skill['name'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($address)
                            <hr class="my-6 border-t border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">
                                    Address
                                </span>
                                <ul>
                                    <li class="mb-2">
                                        <p class="break-all">
                                            {{ ucfirst(strtolower($address->street)) }},
                                            {{ ucfirst(strtolower($address->barangay)) }},
                                            {{ ucfirst(strtolower($address->city)) }},
                                            {{ ucfirst(strtolower($address->province)) }}</p>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-gray-100 shadow-xl shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">About</h2>
                        <p class="text-gray-700">
                            {{ $applicant->about }}
                        </p>
                        <h2 class="text-xl font-bold mt-6 mb-4">
                            Education
                        </h2>
                        @foreach ($applicant_educations as $index => $education)
                            <div class="mb-6">
                                <div class="flex justify-between flex-wrap gap-2 w-full">
                                    <span class="text-gray-700 font-bold">
                                        {{ $education['name'] }}
                                    </span>
                                    <p>
                                        <span class="text-gray-700 mr-2">
                                            {{ $education['pivot']['school_name'] }}
                                        </span>
                                        <span class="text-gray-700">
                                            {{ $education['pivot']['from'] }} - {{ $education['pivot']['to'] }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <h2 class="text-xl font-bold mt-6 mb-4">
                            Experience
                        </h2>
                        @foreach ($applicant_experiences as $index => $experience)
                            <div class="mb-6">
                                <div class="flex justify-between flex-wrap gap-2 w-full">
                                    <span class="text-gray-700 font-bold">
                                        {{ $experience->title }}
                                    </span>
                                    <p>
                                        <span class="text-gray-700 mr-2">
                                            {{ $experience->company_name }}
                                        </span>
                                        <span class="text-gray-700">
                                            {{ $experience->start }} -
                                            {{ $experience->end }}
                                        </span>
                                    </p>
                                </div>
                                <p class="mt-2">
                                    {{ $experience->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
