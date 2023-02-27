<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SignupRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'nama' => 'required|string|max:50|min:3',
            'tempat_lahir' => 'required|string|max:50|min:3',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat' => 'required|string|max:50',
            'telp' => 'required|regex:/^[0-9]{12}$/',
            'asal_sekolah' => 'required|string|max:50',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|min:3|max:50',
            // 'no_surat' => 'required|max:50|string',
            // 'dokumen' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'dokumen' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
                'password' => 'required|min:8|same:password_confirmation',
                'password_confirmation' => 'required|min:8|same:password',
                // 'password' => 'min:8|same:password_confirmation',
            ];
        } else {
            $rules += [
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'dokumen' => 'mimes:jpeg,png,jpg,pdf|max:2048',
                'current_password' => 'min:8|nullable',
                'password' => 'min:8|same:password_confirmation|nullable',
                'password_confirmation' => 'min:8|same:password|nullable',
                'status' => 'required'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah digunakan',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'same' => ':attribute tidak sama dengan :other',
            'date' => ':attribute harus berupa tanggal',
            'numeric' => ':attribute harus berupa angka',
            'regex' => ':attribute panjang 12 karakter',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'nama',
            'tempat_lahir' => 'Tempat lahir',
            'tanggal_lahir' => 'Tanggal lahir',
            'alamat' => 'Alamat',
            'jenis_kelamin' => 'Jenis kelamin',
            'no_hp' => 'No HP',
            'asal_sekolah' => 'Asal sekolah',
            'foto' => 'Foto',
            'username' => 'Username',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
            // 'no_surat' => 'No surat',
            'dokumen' => 'Dokumen',
            'tanggal_awal' => 'Tanggal awal',
            'tanggal_akhir' => 'Tanggal akhir',
            'current_password' => 'Password saat ini',
        ];
    }
}
