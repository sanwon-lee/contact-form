@extends("layouts.app")

@section("title", "Admin")

@section("header_action")
    <form action="{{ route("logout") }}" method="post">
        @csrf
        <button class="header-btn">logout</button>
    </form>
@endsection

@section("content")
    <x-content-title>Admin</x-content-title>

    <div class="mx-auto mbe-24 w-[80%] text-stone-500">
        <form
            action="{{ route("contacts.index") }}"
            method="GET"
            class="mbe-10 flex flex-wrap items-center justify-between gap-4"
        >
            <input
                type="text"
                placeholder="名前やメールアドレスを入力してください"
                name="keyword"
                value="{{ request("keyword") }}"
                class="max-w-[450px] grow truncate bg-zinc-50 px-4 py-2"
            />

            <select
                name="gender"
                value="{{ request("gender") }}"
                class="bg-zinc-50 px-4 py-2"
            >
                <option value="">
                    {{ __("validation.attributes.gender") }}
                </option>
                @foreach ($genders as $value => $name)
                    <option
                        value="{{ $value }}"
                        @selected(request("gender") == $value)
                    >
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            <select
                name="category_id"
                value="{{ request("category_id") }}"
                class="bg-zinc-50 px-4 py-2"
            >
                <option value="">
                    {{ __("validation.attributes.category_id") }}
                </option>
                @foreach ($categories as $category)
                    <option
                        name="category_id"
                        value="{{ $category->id }}"
                        @selected(request("category_id") == $category->id)
                    >
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input
                type="date"
                name="created_at"
                value="{{ request("created_at") }}"
                class="bg-zinc-50 px-4 py-2"
            />

            <button
                class="max-w-20 min-w-fit grow cursor-pointer bg-[#82756a] px-4 py-2 text-white"
            >
                検索
            </button>
            <a
                href="{{ route("contacts.index") }}"
                class="max-w-20 min-w-fit grow bg-[#d9c6b5] px-4 py-2 text-center text-white"
            >
                リセット
            </a>
        </form>

        <div class="flex justify-between">
            <a
                href="{{ route("contacts.export", request()->query()) }}"
                class="bg-[#edeae6] px-4 py-2"
            >
                エクスポート
            </a>
            {{ $contacts->links("vendor.pagination.tailwind") }}
        </div>

        <table class="mbs-12 w-full border-collapse">
            <tr class="bold bg-[#8b7969]">
                <th class="w-1/5 px-4 py-2 text-left text-white">
                    {{ __("validation.attributes.full_name") }}
                </th>
                <th class="w-1/10 px-4 py-2 text-left text-white">
                    {{ __("validation.attributes.gender") }}
                </th>
                <th class="w-3/10 px-4 py-2 text-left text-white">
                    {{ __("validation.attributes.email") }}
                </th>
                <th colspan="2" class="w-2/5 px-4 py-2 text-left text-white">
                    {{ __("validation.attributes.category_id") }}
                </th>
            </tr>
            @foreach ($contacts as $contact)
                <tr
                    x-data="{ open: false }"
                    wire:key="row-{{ $contact->id }}"
                    class="border-x border-b border-[#e7e5e4] hover:bg-stone-200"
                >
                    <td class="px-4 py-4">{{ $contact->full_name }}</td>
                    <td class="px-4 py-4">
                        {{ $contact->gender->label() }}
                    </td>
                    <td class="px-4 py-4">{{ $contact->email }}</td>
                    <td class="px-4 py-4">
                        {{ $contact->category->content }}
                    </td>
                    <td class="px-4 py-4">
                        <button
                            @click="open = true"
                            class="min-w-fit cursor-pointer border-1 border-[#d9c6b5] bg-[#fcfcfc] px-4 py-1 text-[#d9c6b5]"
                        >
                            詳細
                        </button>
                        <x-contact-detail-modal
                            :contact="$contact"
                            wire:key="modal-{{ $contact->id }}"
                        />
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
