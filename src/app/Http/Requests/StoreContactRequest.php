<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
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
            Contact::COL_CATEGORY_ID => ['required',],
            Contact::COL_FIRST_NAME  => ['required', 'string',],
            Contact::COL_LAST_NAME   => ['required', 'string',],
            Contact::COL_GENDER      => ['required',],
            Contact::COL_EMAIL       => ['required', 'email',],
            Contact::COL_TEL         => ['required', 'integer', 'max_digits:5',],
            Contact::COL_ADDRESS     => ['required',],
            Contact::COL_DETAIL      => ['required', 'max:120'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $first = $this->input(Contact::COL_FIRST_NAME);
            $last = $this->input(Contact::COL_LAST_NAME);

            if (mb_strlen($first . $last) > 9) {
                $validator->errors()->add(
                    Contact::getLabel('full_name'),
                    '氏名は合計8文字以下で入力してください'
                );
            }
        });
    }
}
