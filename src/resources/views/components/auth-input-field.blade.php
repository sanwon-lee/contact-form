@use("App\Models\User")

@props([
    "field",
])

<div class="relative mbe-8">
    <label for="{{ $field }}" class="mbe-2 block text-xl text-stone-500">
        {{ User::getLabel($field) ?? $field }}
    </label>
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
