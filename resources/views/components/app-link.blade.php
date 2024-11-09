@props(['active', 'to'])


<li>
    <a href="{{ $to }}" wire:navigate
        class="block py-2 px-3 md:p-2 rounded {{ $active ? 'text-white bg-blue-700  md:bg-transparent md:text-blue-700' : 'text-gray-900  hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700' }}"
        aria-current="page">{{ $slot }}</a>
</li>
