<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Helpers;
use Illuminate\Support\Str;

class CreatePsychologistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Sanitización previa.
    protected function prepareForValidation()
    {
        $this->merge([
            'full_name' => Helpers::emptyToNull($this->input('full_name')),
            'name' => Helpers::emptyToNull($this->input('name')),
            'email' => Helpers::emptyToNull($this->input('email')),
            'phone_number' => Helpers::emptyToNull($this->input('phone_number')),
            'password' => Helpers::emptyToNull($this->input('password')),
            'confirm_password' => Helpers::emptyToNull($this->input('confirm_password')),
            'professional_license' => Helpers::emptyToNull($this->input('professional_license')),
            'curp' => Helpers::emptyToNull($this->input('curp')),
            'home_address' => Helpers::emptyToNull($this->input('home_address')),
            'years_experience' => Helpers::emptyToNull($this->input('years_experience')),
            'consultation_fee' => Helpers::emptyToNull($this->input('consultation_fee')),
            'professional_bio' => Helpers::emptyToNull($this->input('professional_bio')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:5|max:255|unique:users,full_name',
            'name' => 'required|string|min:5|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|string|min:10|max:12|regex:/^\d{10,12}$/|unique:users,phone_number',
            'password' => 'required|string|min:8|max:255',
            'confirm_password' => 'required|string|min:8|max:255|same:password',
            'specialty' => 'required|array|min:1|max:7',
            'specialty.*' => [
                'required',
                'distinct',
                'in:ansiedad,depresión,terapia de pareja,adolescentes,terapia familiar,duelo,adicciones'
            ],
            'professional_license' => 'required|string|min:5|max:15|unique:psychologists,professional_license',
            'curp' => [
                'required',
                'string',
                'size:18',
                'unique:users,curp'
            ],
            'home_address' => 'required|string|min:5|max:5000',
            'years_experience' => 'required|integer|min:0|max:50',
            'consultation_fee' => 'nullable|numeric|min:0|max:9999.99',
            'professional_bio' => 'nullable|string|max:30000',
            'avatar_url' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'El campo de nombre completo es obligatorio.',
            'fullname.string' => 'El nombre completo debe ser una cadena de texto.',
            'fullname.min' => 'El nombre completo debe tener al menos 5 caracteres.',
            'fullname.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'fullname.unique' => 'El nombre completo ya está en uso.',

            'name.required' => 'El campo de nombre de usuario es obligatorio.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre de usuario ya está en uso.',

            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'phone_number.required' => 'El campo de teléfono es obligatorio.',
            'phone_number.string' => 'El teléfono debe ser una cadena de texto.',
            'phone_number.min' => 'El teléfono debe tener al menos 10 dígitos.',
            'phone_number.max' => 'El teléfono no puede tener más de 12 dígitos.',
            'phone_number.regex' => 'El teléfono debe contener solo números (10 a 12 dígitos).',
            'phone_number.unique' => 'El teléfono ya está en uso.',

            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 255 caracteres.',

            'confirm_password.required' => 'El campo de confirmación de contraseña es obligatorio.',
            'confirm_password.string' => 'La confirmación de contraseña debe ser una cadena de texto.',
            'confirm_password.min' => 'La confirmación de contraseña debe tener al menos 8 caracteres.',
            'confirm_password.max' => 'La confirmación de contraseña debe tener como máximo 255 caracteres.',
            'confirm_password.same' => 'La confirmación de contraseña debe ser igual a la contraseña.',

            'specialty.required' => 'El campo de especialidades es obligatorio.',
            'specialty.array' => 'El campo de especialidades debe ser una lista válida.',
            'specialty.min' => 'Debes seleccionar al menos 1 especialidad.',
            'specialty.max' => 'Puedes seleccionar como máximo 7 especialidades.',
            'specialty.*.required' => 'La especialidad no puede estar vacía.',
            'specialty.*.distinct' => 'No puedes repetir especialidades.',
            'specialty.*.in' => 'La especialidad seleccionada (:input) no es válida.',

            'professional_license.required' => 'El campo de cédula profesional es obligatorio.',
            'professional_license.string' => 'La cédula profesional debe ser una cadena de texto.',
            'professional_license.min' => 'La cédula profesional debe tener al menos 5 caracteres.',
            'professional_license.max' => 'La cédula profesional no puede tener más de 15 caracteres.',
            'professional_license.unique' => 'La cédula profesional ya está registrada.',

            'curp.required' => 'El campo de CURP es obligatorio.',
            'curp.string' => 'El CURP debe ser una cadena de texto.',
            'curp.size' => 'El CURP debe tener exactamente 18 caracteres.',
            'curp.unique' => 'Este CURP ya está registrado.',

            'home_address.required' => 'El campo de domicilio es obligatorio.',
            'home_address.string' => 'El domicilio debe ser una cadena de texto.',
            'home_address.min' => 'El domicilio debe tener al menos 5 caracteres.',
            'home_address.max' => 'El domicilio no puede tener más de 5000 caracteres.',

            'years_experience.required' => 'Los años de experiencia son obligatorios.',
            'years_experience.integer' => 'Los años de experiencia deben ser un número entero.',
            'years_experience.min' => 'Los años de experiencia no pueden ser negativos.',
            'years_experience.max' => 'Los años de experiencia no pueden superar los 50 años.',

            'consultation_fee.numeric' => 'El costo de consulta debe ser un número válido.',
            'consultation_fee.min' => 'El costo de consulta no puede ser menor a 0.',
            'consultation_fee.max' => 'El costo de consulta no puede superar los 9,999.99.',

            'professional_bio.string' => 'La biografía profesional debe ser una cadena de texto.',
            'professional_bio.max' => 'La biografía profesional es demasiado larga.',

            'avatar_url.file' => 'El avatar debe ser un archivo válido.',
            'avatar_url.image' => 'El avatar debe ser una imagen.',
            'avatar_url.mimes' => 'El avatar debe ser una imagen en formato .jpg, .jpeg o .png.',
            'avatar_url.max' => 'El avatar no puede pesar más de 2 MB (2048 KB).',
        ];
    }
}
