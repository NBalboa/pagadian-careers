<div>
    <h2 class="text-3xl mb-2">List of Companies</h2>
    <x-table-layout>
        <x-table-header>
            <x-table-header-item>Name</x-table-header-item>
            <x-table-header-item>Url</x-table-header-item>
            <x-table-header-item>Address</x-table-header-item>
            <x-table-header-item>Action</x-table-header-item>
        </x-table-header>
        <tbody>
            @foreach ($companies as $company)
                <x-table-row>
                    <x-table-row-item>{{ $company->name }}</x-table-row-item>
                    <x-table-row-item>{{ $company->url }}</x-table-row-item>
                    <x-table-row-item>
                        {{ mb_strtolower($company->address->street) }},
                        {{ mb_strtolower($company->address->barangay) }},
                        {{ mb_strtolower($company->address->city) }},
                        {{ mb_strtolower($company->address->province) }}
                    </x-table-row-item>
                    <x-table-row-item>
                        <a href="company/edit/{{ $company->id }}"
                            class="font-medium text-blue-600  hover:underline">Edit</a>
                        <button class="font-medium text-red-600  hover:underline" wire:click="delete({{ $company->id }})"
                            wire:confirm="Are you sure about that?">Delete</button>
                    </x-table-row-item>
                </x-table-row>
            @endforeach

        </tbody>
    </x-table-layout>
    <a href="/company/create" style="float: right; display: inline-block; margin-top: 1rem;"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Create Company
    </a>
</div>
