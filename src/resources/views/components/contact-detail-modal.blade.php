@props([
    "contact",
])

<div
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    @click="open = false"
>
    <div
        @click.stop
        class="relative w-full max-w-2xl border border-stone-300 bg-white p-12 shadow-lg"
    >
        <div class="absolute top-4 right-4">
            <button
                @click="open = false"
                class="flex size-8 cursor-pointer items-center justify-center rounded-full border-2 border-stone-400 leading-none text-stone-400 transition-colors hover:bg-stone-100 hover:text-stone-600"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <table class="mbs-8 w-full border-collapse text-left">
            <tbody class="space-y-4">
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.name") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->full_name }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.gender") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->gender->label() }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.email") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->email }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.tel") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->tel }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.address") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->address }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.building") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->building }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.category_id") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {{ $contact->category->content }}
                    </td>
                </tr>
                <tr class="flex py-2">
                    <th class="bold w-1/3 text-[#8b7969]">
                        {{ __("validation.attributes.detail") }}
                    </th>
                    <td class="w-2/3 text-[#8b7969]">
                        {!! nl2br(e($contact->detail)) !!}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mbs-12 flex justify-center">
            <form
                action="{{ route("contacts.destroy", $contact) }}"
                method="POST"
            >
                @csrf
                @method("DELETE")
                <button
                    class="cursor-pointer bg-red-700 px-10 py-2 text-white transition-colors hover:bg-red-800"
                >
                    削除
                </button>
            </form>
        </div>
    </div>
</div>
