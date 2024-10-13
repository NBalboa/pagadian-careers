<div class="my-5">
    <div class="rounded-lg shadow mx-3 my-2 p-3 ">
        <div>
            <div class="rounded-full overflow-hidden h-32 w-32 border border-4 border-gray-500 ">
                <img src=" {{ asset('storage/' . $company->profile) }} " alt="sample image" class="object-cover">
            </div>
        </div>
        <div class="mt-2">
            <h3 class="text-xl font-bold tracking-light"> {{ $job->job_title }}
            </h3>
            @if ($address)
                <p class="text-sm"> {{ $address->street }}, {{ $address->barangay }}, {{ $address->city }},
                    {{ $address->province }} </p>
            @endif
        </div>
        <h3 class="text-md font-bold">Contact Info</h3>
        <div>
            <p class="text-md"> {{ $user->email }} <span class="text-sm">(email)</span></p>
            <p class="text-md"> {{ $user->phone_no }} <span class="text-sm">(phone)</span></p>
        </div>
        @if ($job->show_salary === 1 && $job->salary !== null)
            <h3 class="text-md font-bold">Salary</h3>
            <p>{{ $job->salary }}</p>
        @endif
        <h3 class="text-md font-bold">Description</h3>

        <p> {{ $job->description }} </p>

        <h3 class="text-md font-bold">Years of Experience</h3>
        <p>{{ $job->experience }}</p>

        <h3 class="text-md font-bold">Skill</h3>
        <p>
            @foreach ($skills as $index => $skill)
                @if (count($skills) - 1 !== $index)
                    {{ $skill['name'] }} •
                @else
                    {{ $skill['name'] }}
                @endif
            @endforeach
        </p>
        <h3 class="text-md font-bold">Responsibilities</h3>
        <ul class="list-disc ms-2 ps-4">
            @foreach ($responsibilities as $responsibility)
                <li>{{ $responsibility->description }}</li>
            @endforeach
        </ul>

        <h3 class="text-md font-bold">Qualifications</h3>
        <ul class="list-disc ms-2 ps-4">
            @foreach ($qualifications as $qualification)
                <li>{{ $qualification->description }}</li>
            @endforeach
        </ul>

        <h3 class="text-md font-bold">Education</h3>
        @foreach ($educations as $index => $education)
            <ul class="list-disc ms-2 ps-4">
                <li>{{ $education['name'] }}</li>
            </ul>
        @endforeach

        @if (!$this->appliedJob())
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2"
                wire:click="applyJob({{ $job->id }})">Apply</button>
        @endif
    </div>

</div>
