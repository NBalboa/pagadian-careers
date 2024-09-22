<div>
    <div class="mb-2">
        <a href="/my/job/"
            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-1/4">Back</a>
    </div>
    <h2 class="text-3xl mb-2">Applicants</h2>
    <x-table-layout>

        <x-table-header>
            <x-table-header-item>Applicant Name</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
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
                    <x-table-row-item>{{ $applicant->user->last_name }},
                        {{ $applicant->user->first_name }}</x-table-row-item>
                    @if (!$applicant->address)
                        <x-table-row-item>No Address</x-table-row-item>
                    @else
                        <x-table-row-item>{{ $applicant->address->street }}</x-table-row-item>
                    @endif
                    <x-table-row-item>{{ $this->getGender($applicant->gender) }}</x-table-row-item>
                    <x-table-row-item>
                        <select id="applicant_status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            wire:model= "statuses.{{ $applicant->id }}">
                            <option value="0">PENDING</option>
                            <option value="1">INTERVIEW</option>
                            <option value="2">HIRED</option>
                        </select>
                    </x-table-row-item>
                    <x-table-row-item>
                        <textarea
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            wire:model="remarks.{{ $applicant->id }}"></textarea>
                    </x-table-row-item>
                    <x-table-row-item>0</x-table-row-item>
                    <x-table-row-item>0</x-table-row-item>
                    <x-table-row-item>
                        <div class="flex flex-row gap-x-4 items-center">
                            <button wire:click="save({{ $applicant->id }})"
                                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-full md:w-auto">
                                Save
                            </button>
                            <a href="/my/job/{{ $job->id }}/applicant/profile/{{ $applicant->id }}"
                                class="font-medium text-green-600 hover:underline">
                                Profile
                            </a>
                        </div>
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>
</div>
