<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'nama' => 'required',
            'keterangan' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama divisi',
            'keterangan' => 'Keterangan'
        ];
    }
}
