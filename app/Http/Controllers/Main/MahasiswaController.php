<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $divisi = Divisi::where('status', true)->pluck('nama_divisi', 'uuid')->prepend('Tampilkan semua', '');
        return view('main.mahasiswa.index')->with([
            'divisi' => $divisi
        ]);
    }

    public function render($uuid)
    {
        if($uuid == 'semua') {
            $mahasiswa = Mahasiswa::all();
        } else {
            $mahasiswa = Mahasiswa::whereHas('pendaftaran.divisi', function($query) use($uuid) {
                $query->where('uuid', $uuid);
            })->get();
        }

        $view = [
            'data' => view('main.mahasiswa.render', compact('mahasiswa'))->render(),
        ];

        return response()->json($view);
    }

    public function validateData($uuid)
    {
        try {
            $data = Mahasiswa::where('uuid', $uuid)->first();
            if($data->is_active == true) {
                $update = [
                    'is_active' => false,
                ];
            } else {
                $update = [
                    'is_active' => true,
                ];
            }
            $data->update($update);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }
}
