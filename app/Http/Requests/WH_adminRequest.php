<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WH_adminRequest extends FormRequest
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
            'StartingTime'=>["sometimes",'required',"after:08:00","before:17:00"],
            'EndingTime'=>["sometimes",'required',"after:09:00","before:18:00"],
            'status'=>["sometimes",'required','boolean'],
            'doctor_id'=>['required','exists:doctors,id'],
            'day_id'=>['sometimes','required','exists:days_of_weeks,id']
        ];
    }
}
