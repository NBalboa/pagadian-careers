<div>

    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div>
            <a href="/my/profile" class="px-4 py-2 rounded bg-blue text-white text-semibold bg-blue-600 text-md">Back</a>
        </div>
        <x-form-wrapper>

            <div class="space-y-4">
                <div>
                    <label for="school_name" class="block mb-2 text-sm font-medium text-gray-900 ">
                        School Name<x-required /></label>
                    <input type="text" name="school_name" id="school_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        placeholder="ex. Juan" required wire:model="school_name" />
                    <div class="text-red-600">
                        @error('school_name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="from" class="block mb-2 text-sm font-medium text-gray-900 ">
                        From</label>
                    <input type="number" name="from" id="from"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        required wire:model="from" />
                    <div class="text-red-600">
                        @error('from')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="to" class="block mb-2 text-sm font-medium text-gray-900 ">
                        To</label>
                    <input type="number" name="to" id="to"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    "
                        required wire:model="to" />
                    <div class="text-red-600">
                        @error('to')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="educations" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Program/Courses</label>
                    <input type="text" list="educations" name="input_educations"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        wire:model.live="input_educations" />
                    @error('input_educations')
                        <div class="text-red-600">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    @error('applicant_educations')
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
                        class=" text-white bg-blue-700 mt-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        wire:click='addApplicantEducation'>Add Education</button>
                </div>
            </div>
        </x-form-wrapper>
        @if ($applicant_educations)

            <div class="bg-gray">
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-gray-100 shadow-xl shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mt-6 mb-4  gap-2">
                            Education
                        </h2>
                        @foreach ($applicant_educations as $index => $education)
                            <div class="mb-6">
                                <div class="flex justify-between flex-wrap gap-2 w-full">
                                    <span class="text-gray-700 font-bold">
                                        {{ $education['name'] }}
                                        <div class="mt-2">
                                            <a href="/my/profile/edit/education/{{ $education['id'] }}"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                                wire:click="removeApplicantEducation({{ $education['id'] }})"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </div>
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
                    </div>
                </div>
            </div>
        @endif
    </div>

</div>
