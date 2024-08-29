<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PhotoStoreRequest extends FormRequest
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
        $rules = [];

        // For store method: image is required as an image
        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
        }
    
        // For update method: image is optional
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (is_string($value)) {
                        // Check if the string is a valid storage path and if the file exists
                        $storagePath = 'public' . str_replace('/storage', '', $value);
                        if (!Storage::exists($storagePath)) {
                            $fail($attribute . ' must be a valid URL and the file must exist.');
                        }
                    } else if (!($value instanceof \Illuminate\Http\UploadedFile)) {
                        $fail($attribute . ' must be a valid URL or image file.');
                    }
                },
                'max:2048',
            ];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator->errors())->withInput()
        );
    }
}
