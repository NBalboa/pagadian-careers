<div>
    <div class="mt-2 pb-2 ms-3">
        <a href="/applicants"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2">Back</a>
    </div>
    <div>

        <div class="mt-2 bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">

            <div>
                <div class="rounded-full overflow-hidden h-32 w-32 border border-4 border-gray-500 ">
                    <img src="{{ asset('storage/' . $applicant->profile) }}" alt="sample image" class="object-cover">
                </div>
            </div>
            <div class="mt-2">
                <h3 class="text-xl font-bold tracking-light">{{ ucfirst($applicant->user->first_name) }}
                    {{ ucfirst($applicant->user->last_name) }} <span
                        class="font-normal text-sm">({{ $this->getGender($applicant->gender) }})</span>
                </h3>
                @if ($address)
                    <p class="text-sm">{{ $address->street }}, {{ $address->barangay }}, {{ $address->city }},
                        {{ $address->province }}</p>
                @endif
            </div>

            @if ($applicant->resume)
                <div>
                    <a href="{{ asset('storage/' . $applicant->resume) }}" class="text-blue-500">Applicant Resume</a>
                </div>
            @endif
        </div>
        <div class="bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">
            <h3 class="text-md font-bold">Contact Info</h3>
            <div>
                <p class="text-md">{{ $applicant->user->email }} <span class="text-sm">(email)</span></p>

                <p class="text-md">{{ $applicant->user->phone_no }} <span class="text-sm">(phone)</span></p>

            </div>
        </div>
        <div class="bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">
            <h3 class="text-md font-bold">About</h3>
            <p>{{ $applicant->about }}</p>
        </div>

        <div class="bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">

            </a>
            <h3 class="text-md font-bold">Education</h3>
            @if ($applicant->edu_attainment)
                <div class="mb-2">
                    <p class="text-md">{{ $this->getEduAttainment($applicant->edu_attainment) }} <span
                            class="text-sm">(Education Attainment)</span></p>
                </div>
            @endif

            @foreach ($applicant_educations as $index => $education)
                @if (count($applicant_educations) - 1 !== $index)
                    <div class="border-b-2 border-gray-200 py-2">
                        <h4 class="font-bold text-md">{{ $education['pivot']['school_name'] }}<span
                                class="font-normal">({{ $education['pivot']['from'] }}-{{ $education['pivot']['to'] }})</span>
                        </h4>

                        <p>{{ $education['name'] }}</p>
                    </div>
                @else
                    <div class="py-2">
                        <h4 class="font-bold text-md">{{ $education['pivot']['school_name'] }}<span
                                class="font-normal">({{ $education['pivot']['from'] }}-{{ $education['pivot']['to'] }})</span>
                        </h4>
                        <p>{{ $education['name'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">

            <h3 class="text-md font-bold">Experience</h3>

            @foreach ($applicant_experiences as $index => $experience)
                @if (count($applicant_experiences) - 1 !== $index)
                    <div class="border-b-2 border-gray-200 py-2">
                        <div class="relative">
                            <h4 class="font-bold text-md">{{ $experience->title }}<span class="font-normal text-sm">
                                    ({{ $experience->start }}-{{ $experience->end }})
                                </span>
                            </h4>
                            <p class="absolute -bottom-3">{{ $experience->company_name }}</p>
                        </div>
                        <p class="mt-2">
                            {{ $experience->description }}
                        </p>
                    </div>
                @else
                    <div class=" py-2">
                        <div class="relative">
                            <h4 class="font-bold text-md">{{ $experience->title }}<span class="font-normal text-sm">
                                    ({{ $experience->start }}-{{ $experience->end }})
                                </span>
                            </h4>
                            <p class="absolute -bottom-3">{{ $experience->company_name }}</p>
                        </div>
                        <p class="mt-2">
                            {{ $experience->description }}
                        </p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="bg-gray-100 rounded-lg shadow mx-3 my-2 p-3 border border-4 border-blue-700">

            <h3 class="text-md font-bold">Skill</h3>
            <p>
                @foreach ($applicant_skills as $index => $skill)
                    @if (count($applicant_skills) - 1 !== $index)
                        {{ $skill['name'] }} •
                    @else
                        {{ $skill['name'] }}
                    @endif
                @endforeach
            </p>
        </div>
    </div>
</div>
