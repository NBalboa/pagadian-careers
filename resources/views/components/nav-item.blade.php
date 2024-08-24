@props(['href'])

<li>
    <a href="{{ $href }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group active">
        <span class="ms-3">{{ $slot }}</span>
    </a>
</li>
