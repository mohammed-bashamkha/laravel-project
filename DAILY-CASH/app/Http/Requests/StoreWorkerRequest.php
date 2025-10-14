<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'daily_wage' => 'required|numeric',
            'monthly_wage' => 'required|numeric',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ];
    }
}
