<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|string',
            'type' => 'nullable|string',
            'position' => 'nullable|string',
            'platform' => 'nullable|string',
            'placement' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title_ar.required' => 'The title ar field is required.',
            'title_en.required' => 'The title en field is required.',
            'description_ar.required' => 'The description ar field is required.',
            'description_en.required' => 'The description en field is required.',
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be an image and must be a file of type: jpeg, png, jpg, gif.',
            'link.string' => 'The link field must be a string.',
            'type.string' => 'The type field must be a string.',
            'position.string' => 'The position field must be a string.',
            'platform.string' => 'The platform field must be a string.',
            'placement.string' => 'The placement field must be a string.',
        ];
    }
}
