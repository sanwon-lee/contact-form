@props([
    "action",
    "label",
])

<form
    {{
        $attributes->merge([
            "action" => $action,
            "method" => "post",
            "novalidate" => true,
        ])
    }}
>
    @csrf
    {{ $slot }}

    <button class="mx-auto block bg-stone-500 px-6 py-2 text-white">
        {{ $label }}
    </button>
</form>
