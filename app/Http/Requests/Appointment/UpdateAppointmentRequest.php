<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', App\Models\Appointment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required_if:role,admin|required_if:role,doctor|required_if:role,patient',
            "reasons" => "required_if:status,cancelled"
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException([
            response()->json([
                "error" => $validator->errors()
            ])
        ]);
    }
}
