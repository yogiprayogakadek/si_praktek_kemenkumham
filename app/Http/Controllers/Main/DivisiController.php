<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\DivisiRequest;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DivisiController extends Controller
{
    public function index()
    {
        return view('main.divisi.index');
    }

    public function render()
    {
        $divisi = Divisi::all();

        $view = [
            'data' => view('main.divisi.render', compact('divisi'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.divisi.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(DivisiRequest $request)
    {
        try {
            $salt = env('SALT_CODE');
            $uuid = $uuid = Hash::make($salt . Uuid::uuid4()->toString() . $salt);
            $data = [
                'nama_divisi' => $request->nama,
                'kuota' => $request->kuota,
                'keterangan' => $request->keterangan,
                'uuid' => preg_replace('/[\/\\\\]/', '', $uuid)
            ];

            Divisi::create($data);

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

    public function edit($uuid) 
    {
        $divisi = Divisi::where('uuid', $uuid)->first();
        $view = [
            'data' => view('main.divisi.edit', compact('divisi'))->render()
        ];

        return response()->json($view);
    }

    public function update(DivisiRequest $request)
    {
        try {
            $divisi = Divisi::where('uuid', $request->uuid)->first();
            $data = [
                'nama_divisi' => $request->nama,
                'kuota' => $request->kuota,
                'keterangan' => $request->keterangan,
            ];

            $divisi->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Terjadi kesalahan',
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function validateData($uuid)
    {
        try {
            $data = Divisi::where('uuid', $uuid)->first();
            if($data->status == true) {
                $update = [
                    'status' => false,
                ];
            } else {
                $update = [
                    'status' => true,
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
