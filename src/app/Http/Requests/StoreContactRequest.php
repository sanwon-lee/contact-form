<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Contact::COL_CATEGORY_ID => [
                'required',
                Rule::exists('categories', Category::COL_ID),
            ],
            Contact::COL_FIRST_NAME  => ['required', 'string',],
            Contact::COL_LAST_NAME   => ['required', 'string',],
            Contact::COL_GENDER      => ['required', Rule::enum(Gender::class),],
            Contact::COL_EMAIL       => ['required', 'string', 'email',],
            Contact::COL_TEL         => ['required', 'regex:/^[[:alnum:]]+$/u', 'max_digits:5',],
            Contact::COL_ADDRESS     => ['required', 'string',],
            Contact::COL_BUILDING    => ['nullable', 'string',],
            Contact::COL_DETAIL      => ['required', 'string', 'max:120'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $first = $this->input(Contact::COL_FIRST_NAME);
            $last = $this->input(Contact::COL_LAST_NAME);

            if (mb_strlen($first . $last) > Contact::MAX_FULL_NAME_LENGTH) {
                $validator->errors()->add(
                    'full_name',
                    '氏名は合計' . Contact::MAX_FULL_NAME_LENGTH . '文字以下で入力してください'
                );
            }
        });
    }

    public function attributes(): array
    {
        return collect($this->rules())
            ->keys()
            ->mapWithKeys(fn($key) => [$key => Contact::getLabel($key)])
            ->all();
    }

    public function messages(): array
    {
        return [
            Contact::COL_CATEGORY_ID . '.required' => ':attributeを選択してください',
            Contact::COL_GENDER . '.required'      => ':attributeを選択してください',
            Contact::COL_TEL . '.regex'            => ':attributeは半角英数字で入力してください',
        ];
    }
}
