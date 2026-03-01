<?php

namespace App\Http\Requests;

use App\Enums\Gender;
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

    public function prepareForValidation()
    {
        return $this->merge([
            'tel' => $this->input('tel_1') . $this->input('tel_2') . $this->input('tel_3'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Implement additional validation rules beyond the spec
            'category_id' => ['required', 'exists:categories,id'],
            'first_name'  => ['required', 'string',],
            'last_name'   => ['required', 'string',],
            'gender'      => ['required', Rule::enum(Gender::class),],
            'email'       => ['required', 'string', 'email',],
            'tel_1'       => ['required', 'alpha_num:ascii', 'max_digits:5',],
            'tel_2'       => ['required', 'alpha_num:ascii', 'max_digits:5',],
            'tel_3'       => ['required', 'alpha_num:ascii', 'max_digits:5',],
            'tel'         => ['required',],
            'address'     => ['required', 'string',],
            'building'    => ['nullable', 'string',],
            'detail'      => ['required', 'string', 'max:' . Contact::MAX_DETAIL_LENGTH,],
        ];
    }

    /**
     * Custom validation logic after the standard rules.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $first = $this->input('first_name');
            $last = $this->input('last_name');

            if (mb_strlen($first . $last) > Contact::MAX_FULL_NAME_LENGTH) {
                $validator->errors()->add(
                    'last_name',
                    '氏名は合計' . Contact::MAX_FULL_NAME_LENGTH . '文字以下で入力してください'
                );
            }

            if (!$this->input('tel_1') || !$this->input('tel_2') || !$this->input('tel_3')) {
                $validator->errors()->add(
                    'tel',
                    __('validation.required', ['attribute', $this->attributes()['tel']])
                );
            }
        });
    }

    public function attributes()
    {
        return [
            'tel'   => __('validation.attributes.tel'),
            'tel_1' => __('validation.attributes.tel'),
            'tel_2' => __('validation.attributes.tel'),
            'tel_3' => __('validation.attributes.tel'),
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => ':attributeを選択してください',
            'gender.required'      => ':attributeを選択してください',
        ];
    }
}
