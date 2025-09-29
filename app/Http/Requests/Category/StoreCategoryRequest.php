<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'section_id' => 'nullable|exists:sections,id',
            'parent_id' => 'nullable|exists:categories,id',
            'point' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
    public function messages(): array
    {
        return [
            'name_ar.required' => 'The name ar field is required.',
            'name_ar.string' => 'The name ar field must be a string.',
            'name_ar.max' => 'The name ar field must be less than 255 characters.',
            'name_en.required' => 'The name en field is required.',
            'name_en.string' => 'The name en field must be a string.',
            'name_en.max' => 'The name en field must be less than 255 characters.',
            'description_ar.required' => 'The description ar field is required.',
            'description_en.required' => 'The description en field is required.',
            'section_id.exists' => 'The section field is invalid.',
            'parent_id.exists' => 'The parent category field is invalid.',
            'point.numeric' => 'The point field must be a number.',
            'point.min' => 'The point field must be greater than 0.',
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be an image and must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image field must be less than 2048 kilobytes.',
        ];
    }
}
