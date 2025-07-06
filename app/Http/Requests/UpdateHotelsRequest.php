<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHotelsRequest extends FormRequest
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
            'name'           => ['required', 'max:255', Rule::unique('hotels', 'name')->ignore($this->route('id'))],
            'nit'            => ['required', 'max:10', Rule::unique('hotels', 'nit')->ignore($this->route('id'))],
            'address'        => ['required', 'max:255'],
            'city_id'        => 'required',
            'rooms_capacity' => ['required', 'integer', 'min:0'],
            'email'          => ['required', 'email', Rule::unique('hotels', 'email')->ignore($this->route('id'))],
            'phone'          => ['required', 'max:10'],
            'status'         => ['sometimes', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'name.required'           => 'El nombre del hotel es requerido',
            'name.max'                => 'El nombre no puede sobrepasar los 255 caracteres',
            'name.unique'             => 'El nombre del hotel ya existe, debe ingresar otro',
            'nit.required'            => 'El nit del hotel es obligatorio',
            'nit.max'                 => 'El nit solo debe tener 10 caracteres',
            'nit.unique'              => 'El nit ya existe, debe ingresar uno diferente',
            'address.required'        => 'La dirección del hotel es obligatoria',
            'address.max'             => 'La dirección del hotel no puede sobre pasar los 255 caracteres',
            'city_id.required'        => 'La ciudad es obligatoria',
            'rooms_capacity.required' => 'El número de cuartos a configurar es obligatorio',
            'rooms_capacity.integer'  => 'El número de cuartos debe ser solo numerico',
            'rooms_capacity.min'      => 'El número de cuartos no puede ser un numero negativo',
            'email.required'          => 'El correo del hotel es requerido',
            'email.email'             => 'El correo debe tener el formato adecuado',
            'email.unique'            => 'El correo ya existe, use otro diferente',
            'phone.required'          => 'El telefono del hotel es requerido',
            'phone.max'               => 'El telefono debe tener un maximo de 10 digitos'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status') ? 1 : 0
        ]);
    }
}
