<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h2 class="text-3xl mb-2">List of Hiring Managers</h2>
    @if (session('success'))
        <h3 class="text-green-400 text-center pt-2 pb-2">{{ session('success') }}</h3>
    @endif
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Name</x-table-header-item>
            <x-table-header-item>Email</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
            <x-table-header-item>Contact No.</x-table-header-item>
            <x-table-header-item>Telephone No.</x-table-header-item>
            <x-table-header-item>Company</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($hiring_managers as $hiring_manager)
                <x-table-row>
                    <x-table-row-item>
                        {{ $hiring_manager->user->first_name }}
                        {{ $hiring_manager->user->last_name }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->email }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ mb_strtolower($hiring_manager->address->street) }},
                        {{ mb_strtolower($hiring_manager->address->barangay) }},
                        {{ mb_strtolower($hiring_manager->address->city) }},
                        {{ mb_strtolower($hiring_manager->address->province) }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->phone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->user->telephone_no }}
                    </x-table-row-item>
                    <x-table-row-item>
                        {{ $hiring_manager->company->name }}
                    </x-table-row-item>
                    <x-table-row-item>
                        <a href="hiringmanager/edit/{{ $hiring_manager->id }}"
                            class="font-medium text-blue-600  hover:underline">Edit</a>
                        <button class="font-medium text-red-600  hover:underline"
                            wire:click="delete({{ $hiring_manager->id }})"
                            wire:confirm="Are you sure about that?">Delete</button>
                    </x-table-row-item>
                </x-table-row>
            @endforeach
        </tbody>
    </x-table-layout>
    <a href="/hiringmanager/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Hiring Manager
    </a>
</div>
