@props([
    "label",
    "displayData",
    "content",
])

<tr class="border-b border-gray-200">
    <th class="w-1/3 bg-[#8b7969] p-4 text-left align-top text-white">
        {{ __("validation.attributes." . $label) }}
    </th>
    <td class="p-4">
        @if (isset($content))
            {!! $content !!}
        @else
            {{ $displayData[$label] ?? "" }}
        @endif
    </td>
</tr>
