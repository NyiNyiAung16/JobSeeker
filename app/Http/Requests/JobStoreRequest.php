<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Storage;

class JobStoreRequest extends FormRequest
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
        $rules = [
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|min:100',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'close_date' => 'required|date',
        ];
    
        // For store method: image_url is required as an image
        if ($this->isMethod('post')) {
            $rules['image_url'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
        }
    
        // For update method: image_url is optional
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image_url'] = [
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

    public function messages()
    {
        return [
            'image_url.required' => 'Image field is required.',
            'image_url.file' => 'File has to be image.',
            'image_url.mimes' => 'The image must be a file of type:jpg,jpeg,png.',
            'image_url.max' => 'The image size may not be greater than 2 MB.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator->errors())->withInput()
        );
    }
}
