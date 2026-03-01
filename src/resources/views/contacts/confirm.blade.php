@extends("layouts.app")

@section("title", "Confirm")

@section("content")
    <x-content-title>Confirm</x-content-title>

    <form
        action="{{ route("contacts.store") }}"
        method="POST"
        class="mx-auto max-w-3xl p-4"
    >
        @csrf
        <table class="mbe-8 w-full border-collapse border border-gray-200">
            <x-confirm-table-row
                label="full_name"
                :content="$displayData['first_name'] . '　' . $displayData['last_name']"
            />
            <x-confirm-table-row
                label="gender"
                :content="$genders[$displayData['gender']]"
            />
            <x-confirm-table-row label="email" :displayData="$displayData" />
            <x-confirm-table-row label="tel" :displayData="$displayData" />
            <x-confirm-table-row label="address" :displayData="$displayData" />
            <x-confirm-table-row
                label="building"
                :displayData="$displayData"
            />
            <x-confirm-table-row label="category_id" :content="$category" />
            <x-confirm-table-row
                label="detail"
                :content="nl2br(e($displayData['detail']))"
            />
        </table>

        <div class="flex items-center justify-center gap-8">
            <button
                class="cursor-pointer bg-[#8b7969] px-8 py-2 text-white hover:opacity-90"
            >
                送信する
            </button>
            <button
                name="back"
                value="true"
                class="cursor-pointer text-[#8b7969] underline hover:no-underline"
            >
                修正
            </button>
        </div>
    </form>
@endsection
