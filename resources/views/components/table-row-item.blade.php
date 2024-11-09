@props([
    'isClickable' => false,
    'function' => null,
])

<td class="px-2 py-2 {{ $isClickable ? 'cursor-pointer' : '' }}"
    @if ($function) wire:click="{{ $function }}" wire:navigate @endif>
    {{ $slot }}
</td>
