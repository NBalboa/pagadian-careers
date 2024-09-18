<div>
    {{-- Be like water. --}}
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
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
                    Educations</label>
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

            <div class="bg-gray-100 rounded-lg shadow  my-2 p-3 border border-4 border-blue-700">
                <h3 class="text-md font-bold">Education</h3>
                @foreach ($applicant_educations as $index => $education)
                    @if (count($applicant_educations) - 1 !== $index)
                        <div class="border-b-2 border-gray-200 py-2">
                            <h4 class="font-bold text-md">{{ $education['pivot']['school_name'] }}<span
                                    class="font-normal">({{ $education['pivot']['from'] }}-{{ $education['pivot']['to'] }})</span>
                                <a href="/my/profile/edit/education/{{ $education['id'] }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <button
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                    wire:click="removeApplicantEducation({{ $education['id'] }})"><i
                                        class="fa-solid fa-trash"></i></button>
                            </h4>
                            <p>{{ $education['name'] }}</p>
                        </div>
                    @else
                        <div class="py-2">
                            <h4 class="font-bold text-md">{{ $education['pivot']['school_name'] }}<span
                                    class="font-normal">({{ $education['pivot']['from'] }}-{{ $education['pivot']['to'] }})</span>
                                <a href="/my/profile/edit/education/{{ $education['id'] }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <button
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center"
                                    wire:click="removeApplicantEducation({{ $education['id'] }})"><i
                                        class="fa-solid fa-trash"></i></button>
                            </h4>
                            <p>{{ $education['name'] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
