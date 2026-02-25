@props(['action', 'label'])

<form {{ $attributes->merge([
    'action' => $action,
    'method' => 'post',
]) }}>
    @csrf
    {{ $slot }}

    <button class="block bg-stone-500 mx-auto px-6 py-2 text-white">
        {{ $label }}
    </button>
</form>