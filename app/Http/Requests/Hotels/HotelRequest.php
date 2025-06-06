<?php

namespace App\Http\Requests\Hotels;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            'name'    => ['required', 'max:255'],
            'rooms'   => ['required', 'integer', 'min:0'],
            'address' => ['required', 'max:255'],
            'nit'     => ['required', 'max:10'],
            'city_id' => 'required',
            'status'  => ['sometimes', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'El nombre del hotel es requerido',
            'name.max'         => 'El nombre no puede sobrepasar los 255 caracteres',
            'rooms.required'   => 'El número de cuartos a configurar es obligatorio',
            'rooms.integer'    => 'El número de cuartos debe ser solo numerico',
            'rooms.min'        => 'El número de cuartos no puede ser un numero negativo',
            'address.required' => 'La dirección del hotel es obligatoria',
            'address.max'      => 'La dirección del hotel no puede sobre pasar los 255 caracteres',
            'nit.required'     => 'El nit del hotel es obligatorio',
            'nit.max'          => 'El nit solo debe tener 10 caracteres',
            'city_id.required' => 'La ciudad es obligatoria',
        ];
    }
}
