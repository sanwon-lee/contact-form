@props([
    "field",
])

<div class="relative mbe-8">
    <label for="{{ $field }}" class="font-faustina mbe-2 block text-xl text-stone-500" />
    <input
        {{
            $attributes->merge([
                "id" => $field,
                "name" => $field,
                "class" => "block w-full p-4 bg-stone-200",
            ])
        }}
    />
    @error($field)
        <p class="absolute top-full left-0 text-red-500">{{ $message }}</p>
    @enderror
</div>
