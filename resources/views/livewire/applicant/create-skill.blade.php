<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div>
            <a href="/my/profile" class="px-4 py-2 rounded bg-blue text-white text-semibold bg-blue-600 text-md">Back</a>
        </div>

        <x-form-wrapper>

            <div class="space-y-4">
                <div>
                    <label for="skills" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Skills</label>
                    <input type="text" list="skills"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
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
                        wire:click='addJobSkill'>Save Skill</button>
                </div>
            </div>
        </x-form-wrapper>
        @if ($applicant_skills)
            <div class="bg-gray">
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-gray-100 shadow-xl shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mt-6 mb-4  gap-2">
                            Skills
                        </h2>
                        <ul>
                            @foreach ($applicant_skills as $index => $skill)
                                <li class="mb-2 flex flex-row justify-between">
                                    <p>{{ $skill['name'] }}</p>
                                    <span>
                                        <button
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                            wire:click="removeApplicantSkill({{ $skill['id'] }})"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
