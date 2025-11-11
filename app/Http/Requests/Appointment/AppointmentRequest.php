<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', App\Models\Appointment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "patient_id" => "required|exists:patients,user_id",
            "doctor_id" => "required|exists:doctors,user_id",
            "date" => "required|date|after_or_equal:today",
            "time" => "required|date_format:H:i",
            "status" => "required|in:scheduled,no-show,complete,cancelled"
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                "error" => $validator->errors()
            ])
        );
    }
}
