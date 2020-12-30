<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $thumbCondition = 'bail|required|image';
        if ($this->id) {
            $thumbCondition = 'bail|image';
        }

        return [
            'name' => 'required|max:255|min:5|unique:slider, name',
            'description' => 'required|max:1000|min:5',
            'link' => 'bail|required|max:1000|min:5|url',
            'status' => 'bail|in:active,inactive',
            'thumb' => $thumbCondition,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please input the name field',
            'name.max' => 'Maximum length is :max',
            'name.min' => 'Minimum length is :min. :input is too short',
            'description.required' => 'Please input the description field',
            'description.max' => 'Maximum length is :max',
            'description.min' => 'Minimum length is :min',
            'link.required' => 'Please input the link field',
            'link.max' => 'Maximum length is :max',
            'link.min' => 'Minimum length is :min',
            'link.url' => 'Link is must be an url format'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Slider description',
            'name' => 'Slider name'
        ];
    }
}
