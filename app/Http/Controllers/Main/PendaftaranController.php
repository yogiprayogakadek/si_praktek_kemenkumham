<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('main.pendaftaran.index');
    }

    public function render()
    {
        $pendaftaran = Pendaftaran::all();

        $view = [
            'data' => view('main.pendaftaran.render', compact('pendaftaran'))->render(),
        ];

        return response()->json($view);
    }

    public function edit($uuid) 
    {
        $pendaftaran = Pendaftaran::where('uuid',$uuid)->with('mahasiswa')->first();
        // $view = [
        //     'data' => view('main.pendaftaran.edit', compact('pendaftaran'))->render()
        // ];

        return response()->json($pendaftaran);
    }

    public function update(Request $request)
    {
        try {
            $pendaftaran = Pendaftaran::where($request->uuid)->first();
            $data = [
                'is_approved' => $request->status,
                'keterangan' => $request->keterangan,
            ];

            if($request->hasFile('surat')) {
                unlink($pendaftaran->surat_penerimaan);
                $filenamewithextension = $request->file('surat')->getClientOriginalName();

                //get file extension
                $extension = $request->file('surat')->getClientOriginalExtension();

                //filename to store
                $filenametostore = 'surat-' . str_replace(' ', '', $pendaftaran->mahasiswa->nama) . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/pendaftaran/surat_penerimaan';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                
                $request->file('surat')->move($save_path, $filenametostore);

                $data['surat_penerimaan'] = $save_path . '/' . $filenametostore;
            }

            $pendaftaran->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Terjadi kesalahan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
