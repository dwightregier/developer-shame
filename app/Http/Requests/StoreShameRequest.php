<?php

namespace App\Http\Requests;

/**
 * @property mixed title
 * @property mixed markdown
 * @property mixed is_anonymous
 * @property mixed tags
 */
class StoreShameRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'markdown' => 'required'
        ];
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A shame must have a title',
            'markdown.required' => 'A shame must contain content'
        ];
    }
}
