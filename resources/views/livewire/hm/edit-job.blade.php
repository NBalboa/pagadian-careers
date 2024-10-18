    <div class="p-4 md:p-5">
        <h2 class="text-3xl mb-2">Edit Jobs
            <button type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                wire:click="deleteJob" wire:confirm="Are you sure to delete this job?">Delete</button>
        </h2>
        @if (session('success'))
            <h3 class="text-green-400 text-center pt-2 pb-2">{{ session('success') }}</h3>
        @endif
        <div class="space-y-4">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Job Title<x-required /></label>
                <input type="text" name="job_title" id="job_title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                    placeholder="ex. Juan" required wire:model="job_title" />
                <div class="text-red-600">
                    @error('job_title')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Description</label>
                <textarea id="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  "
                    wire:model="description"></textarea>
                @error('description')
                    <div class="text-red-600">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div>
                <label for="job_setup" class="block mb-2 text-sm font-medium text-gray-900 ">Job
                    Setup<x-required /></label>
                <select id="job_setup"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model='job_setup'>
                    <option selected value="">Select Job Setup</option>
                    <option value="0">On-Site</option>
                    <option value="1">Remote</option>
                    <option value="2">Hybrid</option>

                </select>
                @error('job_setup')
                    <div class="text-red-600">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div>
                <label for="job_type" class="block mb-2 text-sm font-medium text-gray-900 ">Job
                    Type<x-required /></label>
                <select id="job_type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model='job_type'>

                    <option selected value="">Select Job Setup</option>
                    <option value="0">Permanent</option>
                    <option value="1">Part-Time</option>
                    <option value="2">Full-Time</option>
                    <option value="3">Contractual</option>
                </select>
                @error('job_type')
                    <div class="text-red-600">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div>
                <label for="edu_attainment" class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Education
                    Attainment<x-required /></label>
                <select id="edu_attainment"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model="edu_attainment">
                    <option selected value="">Select Education Attainment</option>
                    <option value="0">Elementary Graduate</option>
                    <option value="1">High School Graduate</option>
                    <option value="2">Associate Degree</option>
                    <option value="3">Bachelor's Degree</option>
                    <option value="4">Master's Degree</option>
                    <option value="5">Doctorate Degree</option>
                </select>
                @error('edu_attainment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Salary<x-required /></label>
                <input type="text" name="salary" id="salary"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                    placeholder="ex. Cruz" wire:model="salary" />

                @error('salary')
                    <div class="text-red-600">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>
        <div>
            <label for="max_applicants_hired" class="block mb-2 text-sm font-medium text-gray-900 ">
                No. of Applicants to Hire<x-required /></label>
            <input type="number" name="max_applicants_hired" id="max_applicants_hired"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="" required wire:model="max_applicants_hired" />

            @error('max_applicants_hired')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="mt-2">
            <label for="start_hiring" class="block mb-2 text-sm font-medium text-gray-900 ">
                Hiring Starts<x-required /></label>


            <input type="date" name="start_hiring" id="start_hiring"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                placeholder="" required wire:model="start_hiring" />

            @error('start_hiring')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="mt-2">
            <label for="end_hiring" class="block mb-2 text-sm font-medium text-gray-900">
                Hiring Ends<x-required /></label>
            <input type="date" name="end_hiring" id="end_hiring"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                placeholder="" required wire:model="end_hiring" />

            @error('end_hiring')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model="show_salary" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900">Show Salary</span>
            </label>
        </div>
        <div>
            <label for="experience" class="block mb-2 text-sm font-medium text-gray-900 ">
                Experience</label>
            <input type="number" name="experience" id="experience" wire:model="experience"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="experience" />
            @error('experience')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <h6 class="text-2xl mb-2 mt-2">Scoring <span class="text-sm italic">(must be total of 10)</span></h6>
        @error('total_score')
            <div class="text-red-600">
                <span>{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="education_score" class="block mb-2 text-sm font-medium text-gray-900 ">
                Education</label>
            <input type="number" name="education_score" id="education_score"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="education_score" />
            @error('education_score')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div>
            <label for="skill_score" class="block mb-2 text-sm font-medium text-gray-900 ">
                Skill</label>
            <input type="number" name="skill_score" id="skill_score"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="skill_score" />
            @error('skill_score')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div>
            <label for="experience_score" class="block mb-2 text-sm font-medium text-gray-900 ">
                Experience</label>
            <input type="number" name="experience_score" id="experience_score"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="experience_score" />
            @error('experience_score')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
        <button
            class="text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            wire:click='save'>Save Changes</button>
        <div>
            <label for="qualification" class="block mb-2 text-sm font-medium text-gray-900 ">
                Qualifications</label>

            @error('qualification')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @error('qualifications')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @foreach ($qualifications as $index => $qualification)
                <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-2 mt-2">
                    <input type="text" wire:model='qualifications.{{ $index }}.description'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full sm:w-full md:w-3/4"
                        name="qualifications.{{ $index }}.description"
                        wire:blur="saveEditedQualification({{ $index }})" />

                    <button type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-1/4"
                        wire:click="removeQualification({{ $index }})">
                        Remove
                    </button>
                </div>
            @endforeach
            <input type="text" name="qualification" id="qualification"
                class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                placeholder="ex. Dela" required wire:model="qualification" />
            {{-- <h2 class="mb-2 text-lg font-semibold text-gray-900">Password requirements:</h2> --}}
            <button
                class="text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                wire:click='addJobQualification'>Add Job Qualification</button>

        </div>
        <div>
            <label for="reponsibility" class="block mb-2 text-sm font-medium text-gray-900 ">
                Responsibilities</label>
            @foreach ($responsibilities as $index => $reponsiblity)
                <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-2 mt-2 mb-2">
                    <input type="text" wire:model='responsibilities.{{ $index }}.description'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full sm:w-full md:w-3/4"
                        name="responsibilities.{{ $index }}.description"
                        wire:blur="saveEditedResponsibilities({{ $index }})" />

                    <button type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-1/4"
                        wire:click="removeResponsibilities({{ $index }})">
                        Remove
                    </button>
                </div>
            @endforeach
            <input type="text" name="reponsibility" id="reponsibility"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="ex. Dela" required wire:model="reponsibility" />
            @error('reponsibility')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @error('responsibilities')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            <button
                class="text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                wire:click='addJobResponsibility'>Add Job Responsibility</button>


        </div>
        <div>
            <label for="educations" class="block mb-2 text-sm font-medium text-gray-900 ">
                Educations</label>
            <input type="text" list="educations" name="input_educations"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                wire:model.live="input_educations" />
            @error('input_educations')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @error('job_educations')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <datalist id="educations" class="bg-gray-50 border border-gray-300 w-full">
                @foreach ($list_educations as $education)
                    <option>{{ $education->name }}</option>
                @endforeach
            </datalist>
            <button
                class="text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                wire:click='addJobEducation'>Add Job Education</button>
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside">
                @foreach ($job_educations as $education)
                    <li>
                        {{ $education['name'] }}
                        <button type="button"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                            wire:click="removeJobEducation({{ $education['id'] }})">Remove</button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <label for="skills" class="block mb-2 text-sm font-medium text-gray-900 ">
                Skills</label>
            <input type="text" list="skills"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                wire:model.live="input_skills" name="input_skills" />
            @error('input_skills')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @error('job_skills')
                <div class="text-red-600">
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <datalist id="skills" class="bg-gray-50 border border-gray-300 w-full">
                @foreach ($list_skills as $skill)
                    <option>{{ $skill->name }}</option>
                @endforeach
            </datalist>
            <button
                class="text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                wire:click='addJobSkill'>Save Job Skill</button>
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside">
                @foreach ($job_skills as $skill)
                    <li>
                        {{ $skill['name'] }}
                        <button type="button"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                            wire:click="removeJobSkill({{ $skill['id'] }})">Remove</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
