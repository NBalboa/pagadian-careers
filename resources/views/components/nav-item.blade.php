@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" wire:navigate
        class="flex  items-center p-2 rounded-lg {{ $active ? 'text-blue-700 bg-gray-200' : 'text-white hover:bg-gray-200 hover:text-blue-700' }} group">
        <span class="ms-3">{{ $slot }}</span>
    </a>
</li>
