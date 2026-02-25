@use('App\Models\User')

@props(['field'])

<div class="relative mbe-8">
    <label for="{{ $field }}" class="block text-stone-500 text-xl mbe-2">{{ User::getLabel($field) ?? $field }}</label>
    <input {{ $attributes->merge([
        'id' => $field,
        'name' => $field,
        'class' => "block w-full p-4 bg-stone-200",
    ]) }}>
    @error($field)
    <p class="absolute left-0 top-full text-red-500">{{ $message }}</p>
    @enderror
</div>