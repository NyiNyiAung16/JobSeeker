<?php

namespace App\Http\Requests;

use App\Rules\AcceptTrueOnly;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobApplicationRequest extends FormRequest
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
            'contact.first_name' => 'required|string|max:255',
            'contact.last_name' => 'required|string|max:255',
            'contact.email' => 'required|email|max:255',
            'contact.phone_number' => 'required|numeric',
            'experiences' => 'required|array',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.job_title' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
            'education' => 'required|array',
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date|after_or_equal:education.*.start_date',
            'language' => 'required|array',
            'language.*.name' => 'required|string|max:255',
            'language.*.speaking_level' => 'required|string|in:beginner,intermediate,advanced,fluent',
            'language.*.listening_level' => 'required|string|in:beginner,intermediate,advanced,fluent',
            'language.*.reading_level' => 'required|string|in:beginner,intermediate,advanced,fluent',
            'additional.worked_before_here' => 'nullable|boolean',
            'additional.legally_work' => 'nullable|boolean',
            'additional.resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'additional.agreed_terms' => ['boolean',new AcceptTrueOnly]
        ];
    }

    protected function prepareForValidation()
    {
        // Convert string booleans to actual booleans
        $this->merge([
            'additional' => [
                'worked_before_here' => filter_var($this->input('additional.worked_before_here'), FILTER_VALIDATE_BOOLEAN),
                'legally_work' => filter_var($this->input('additional.legally_work'), FILTER_VALIDATE_BOOLEAN),
                'agreed_terms' => filter_var($this->input('additional.agreed_terms'), FILTER_VALIDATE_BOOLEAN),
            ],
        ]);
    }

    public function messages()
    {
        return [
            'contact.first_name.required' => 'Please enter your first name.',
            'contact.last_name.required' => 'Please enter your last name.',
            'contact.email.required' => 'Please provide your email address.',
            'contact.email.email' => 'Please provide a valid email address.',
            'contact.phone_number.required' => 'Please provide your phone number.',
            'contact.phone_number.numeric' => 'Please provide number only.',
            'language.required' => 'Please add at least one language.',
            'language.*.name.required' => 'Language name is required.',
            'language.*.speaking_level.required' => 'Speaking_level level is required.',
            'language.*.speaking_level.in' => 'Speaking_level level must be one of: beginner, intermediate, advanced, fluent.',
            'language.*.listening_level.required' => 'Listening_level level is required.',
            'language.*.listening_level.in' => 'Listening_level level must be one of: beginner, intermediate, advanced, fluent.',
            'language.*.reading_level.required' => 'Reading_level level is required.',
            'language.*.reading_level.in' => 'Reading_level level must be one of: beginner, intermediate, advanced, fluent.',
            'experiences.required' => 'Please add at least one experience.',
            'experiences.*.company_name.required' => 'Company name is required.',
            'experiences.*.job_title.required' => 'Job title is required.',
            'experiences.*.start_date.required' => 'Start date is required.',
            'experiences.*.end_date.after_or_equal' => 'End date must be after or equal to the start date.',
            'education.required' => 'Please add at least one education entry.',
            'education.*.institution.required' => 'Institution name is required.',
            'education.*.degree.required' => 'Degree is required.',
            'education.*.start_date.required' => 'Start date is required.',
            'education.*.end_date.after_or_equal' => 'End date must be after or equal to the start date.',
            'additional.resume.required' => 'Please upload your resume.',
            'additional.resume.file' => 'The resume must be a valid file.',
            'additional.resume.mimes' => 'The resume must be a file of type: pdf, doc, docx.',
            'additional.resume.max' => 'The resume must not be larger than 2MB.',
            'additional.agreed_terms.boolean' => 'Invalid value for terms and conditions agreement.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator->errors())->withInput()
        );
    }
}
