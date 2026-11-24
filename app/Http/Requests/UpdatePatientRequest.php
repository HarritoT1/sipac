<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Helpers;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $emergency_contacts = json_decode($this->input('emergency_contacts'), true);

        if (!is_array($emergency_contacts)) $emergency_contacts = [];

        // Aplicar sanitización previa a cada contacto de emergencia.

        foreach ($emergency_contacts as $index => $contact) {
            $emergency_contacts[$index]['id'] = Helpers::emptyToNull($contact['id']);
            $emergency_contacts[$index]['name'] = Helpers::emptyToNull($contact['name']);
            $emergency_contacts[$index]['relationship'] = Helpers::emptyToNull($contact['relationship']);
            $emergency_contacts[$index]['phone_number'] = Helpers::emptyToNull($contact['phone_number']);
            $emergency_contacts[$index]['email'] = Helpers::emptyToNull($contact['email']);
            $emergency_contacts[$index]['is_primary'] = boolval($contact['is_primary']);
        }

        $contacts_deleted = null;

        if ($this->has('contacts_deleted')) $contacts_deleted = json_decode($this->input('contacts_deleted'), true);

        $this->merge([
            'full_name' => Helpers::emptyToNull($this->input('full_name')),
            'name' => Helpers::emptyToNull($this->input('name')),
            'phone_number' => Helpers::emptyToNull($this->input('phone_number')),
            'is_active' => Helpers::emptyToNull($this->input('is_active')),
            'curp' => Helpers::emptyToNull($this->input('curp')),
            'home_address' => Helpers::emptyToNull($this->input('home_address')),
            'birth_date' => Helpers::emptyToNull($this->input('birth_date')),
            'gender' => Helpers::emptyToNull($this->input('gender')),
            'emergency_contacts' => $emergency_contacts,
            'contacts_deleted' => $contacts_deleted
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
            'full_name' => 'required|string|min:5|max:255|unique:users,full_name,' . $this->input('user_id'),
            'name' => 'required|string|min:5|max:255|unique:users,name,' . $this->input('user_id'),
            'phone_number' => 'required|string|min:10|max:12|regex:/^\d{10,12}$/|unique:users,phone_number,' . $this->input('user_id'),
            'is_active' => 'required|boolean',
            'curp' => [
                'required',
                'string',
                'size:18',
                'unique:users,curp,' . $this->input('user_id'),
            ],
            'home_address' => 'required|string|min:5|max:5000',
            'birth_date' => ['required', 'string', 'date_format:Y-m-d', 'before:today'],
            'gender' => ['required', 'string', 'in:masculino,femenino,no binario,prefiero no decir'],
            'emergency_contacts' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    $primaries = collect($value)->where('is_primary', true)->count();
                    if ($primaries !== 1) {
                        $fail($attribute . ': Debe haber exactamente un contacto de emergencia principal.');
                    }
                },
            ],
            'emergency_contacts.*.id' => [
                'required',
                'integer',
            ],
            'emergency_contacts.*.name' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'emergency_contacts.*.relationship' => [
                'required',
                'string',
                'in:padre,madre,hermano(a),tio(a),primo(a),amigo(a)'
            ],
            'emergency_contacts.*.phone_number' => [
                'required',
                'string',
                'min:10',
                'max:12',
                'regex:/^\d{10,12}$/',
            ],
            'emergency_contacts.*.email' => [
                'nullable',
                'string',
                'email',
                'max:255',
            ],
            'emergency_contacts.*.is_primary' => [
                'required',
                'boolean',
            ],
            'avatar_url' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            'contacts_deleted' => 'nullable|array',
            'contacts_deleted.*' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'El campo de nombre completo es obligatorio.',
            'full_name.string' => 'El nombre completo debe ser una cadena de texto.',
            'full_name.min' => 'El nombre completo debe tener al menos 5 caracteres.',
            'full_name.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'full_name.unique' => 'El nombre completo ya está en uso.',

            'name.required' => 'El campo de nombre de usuario es obligatorio.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre de usuario ya está en uso.',

            'phone_number.required' => 'El campo de teléfono es obligatorio.',
            'phone_number.string' => 'El teléfono debe ser una cadena de texto.',
            'phone_number.min' => 'El teléfono debe tener al menos 10 dígitos.',
            'phone_number.max' => 'El teléfono no puede tener más de 12 dígitos.',
            'phone_number.regex' => 'El teléfono debe contener solo números (10 a 12 dígitos).',
            'phone_number.unique' => 'El teléfono ya está en uso.',

            'is_active.required' => 'El campo de estado es obligatorio.',
            'is_active.boolean' => 'El estado debe ser un booleano.',

            'curp.required' => 'El campo de CURP es obligatorio.',
            'curp.string' => 'El CURP debe ser una cadena de texto.',
            'curp.size' => 'El CURP debe tener exactamente 18 caracteres.',
            'curp.unique' => 'Este CURP ya está registrado.',

            'home_address.required' => 'El campo de domicilio es obligatorio.',
            'home_address.string' => 'El domicilio debe ser una cadena de texto.',
            'home_address.min' => 'El domicilio debe tener al menos 5 caracteres.',
            'home_address.max' => 'El domicilio no puede tener más de 5000 caracteres.',

            'birth_date.required' => 'El campo de fecha de nacimiento es obligatorio.',
            'birth_date.string' => 'La fecha de nacimiento debe ser una cadena de texto.',
            'birth_date.date_format' => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a la fecha actual.',

            'gender.required' => 'El campo de sexo es obligatorio.',
            'gender.string' => 'El sexo debe ser una cadena de texto.',
            'gender.in' => 'El sexo debe ser masculino, femenino, no binario o prefiero no decir.',

            'emergency_contacts.required' => 'El campo de contactos de emergencia es obligatorio.',
            'emergency_contacts.array' => 'El campo de contactos de emergencia debe ser un array.',
            'emergency_contacts.min' => 'El campo de contactos de emergencia debe tener al menos un contacto.',

            'emergency_contacts.*.id.required' => 'El campo de ID del contacto de emergencia #:position es obligatorio.',
            'emergency_contacts.*.id.integer' => 'El campo de ID del contacto de emergencia #:position debe ser un entero.',

            'emergency_contacts.*.name.required' => 'El campo de nombre del contacto de emergencia #:position es obligatorio.',
            'emergency_contacts.*.name.string' => 'El nombre del contacto de emergencia #:position debe ser una cadena de texto.',
            'emergency_contacts.*.name.min' => 'El nombre del contacto de emergencia #:position debe tener al menos 5 caracteres.',
            'emergency_contacts.*.name.max' => 'El nombre del contacto de emergencia #:position no puede tener más de 255 caracteres.',

            'emergency_contacts.*.relationship.required' => 'El campo de parentesco del contacto de emergencia #:position es obligatorio.',
            'emergency_contacts.*.relationship.string' => 'El parentesco del contacto de emergencia #:position debe ser una cadena de texto.',
            'emergency_contacts.*.relationship.in' => 'El parentesco seleccionado del contacto de emergencia #:position debe ser padre, madre, hermano(a), tio(a), primo(a) o amigo(a).',

            'emergency_contacts.*.phone_number.required' => 'El campo de teléfono del contacto de emergencia #:position es obligatorio.',
            'emergency_contacts.*.phone_number.string' => 'El teléfono del contacto de emergencia #:position debe ser una cadena de texto.',
            'emergency_contacts.*.phone_number.min' => 'El teléfono del contacto de emergencia #:position debe tener al menos 10 dígitos.',
            'emergency_contacts.*.phone_number.max' => 'El teléfono del contacto de emergencia #:position no puede tener más de 12 dígitos.',
            'emergency_contacts.*.phone_number.regex' => 'El teléfono del contacto de emergencia #:position debe contener solo números (10 a 12 dígitos).',

            'emergency_contacts.*.email.string' => 'El correo electrónico del contacto de emergencia #:position debe ser una cadena de texto.',
            'emergency_contacts.*.email.email' => 'El correo electrónico del contacto de emergencia #:position debe ser una dirección válida.',
            'emergency_contacts.*.email.max' => 'El correo electrónico del contacto de emergencia #:position no puede tener más de 255 caracteres.',

            'emergency_contacts.*.is_primary.required' => 'Debes indicar si el contacto de emergencia #:position es principal o no.',
            'emergency_contacts.*.is_primary.boolean' => 'El indicador de contacto principal del contacto de emergencia #:position debe ser verdadero o falso.',

            'avatar_url.file' => 'El avatar debe ser un archivo válido.',
            'avatar_url.image' => 'El avatar debe ser una imagen.',
            'avatar_url.mimes' => 'El avatar debe ser una imagen en formato .jpg, .jpeg o .png.',
            'avatar_url.max' => 'El avatar no puede pesar más de 2 MB (2048 KB).',

            'contacts_deleted.array' => 'El campo de contactos eliminados debe ser un array.',
            'contacts_deleted.*.required' => 'El campo de ID del contacto eliminado #:position es obligatorio.',
            'contacts_deleted.*.integer' => 'El campo de ID del contacto eliminado #:position debe ser un entero.',
        ];
    }
}
