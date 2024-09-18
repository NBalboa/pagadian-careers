<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div class="space-y-4">
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
                    class="w-full text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    wire:click='addJobSkill'>Save Skill</button>
            </div>

            <div class="bg-gray-100 rounded-lg shadow my-2 p-3 border border-4 border-blue-700">
                <h3 class="text-md font-bold">Skill</h3>
                <p>
                    @foreach ($applicant_skills as $index => $skill)
                        @if (count($applicant_skills) - 1 !== $index)
                            {{ $skill['name'] }} <button
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                wire:click="removeApplicantSkill({{ $skill['id'] }})"><i
                                    class="fa-solid fa-trash"></i></button> •
                        @else
                            {{ $skill['name'] }} <button
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                wire:click="removeApplicantSkill({{ $skill['id'] }})"><i
                                    class="fa-solid fa-trash"></i></button>
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
