<div>
    <h2 class="text-3xl mb-2">List of Jobs</h2>
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Title</x-table-header-item>
            <x-table-header-item>Setup</x-table-header-item>
            <x-table-header-item>Type</x-table-header-item>
            <x-table-header-item>Salary</x-table-header-item>
            <x-table-header-item>No. of Applicants</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($jobs as $job)
                <x-table-row>
                    <x-table-row-item>{{ $job->job_title }}</x-table-row-item>
                    <x-table-row-item>{{ $this->getJobSetup($job->job_setup) }}</x-table-row-item>
                    <x-table-row-item>{{ $this->getJobType($job->job_type) }}</x-table-row-item>
                    <x-table-row-item>{{ $job->salary }}</x-table-row-item>
                    <x-table-row-item>0</x-table-row-item>
                    <x-table-row-item>
                        <a href="/job/edit/{{ $hiring_manager->id }}/{{ $job->id }}"
                            class="font-medium text-blue-600  hover:underline">Edit</a>
                        <button class="font-medium text-red-600  hover:underline" wire:click="delete({{ $job->id }})"
                            wire:confirm="Are you sure about that?">Delete</button>
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>

    <a href="/job/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Job
    </a>
</div>
