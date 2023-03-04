<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Middleware\isAdmin;
use App\Models\Divisi;
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
        // $divisi = Divisi::where('status', true)->pluck('nama_divisi', 'id')->prepend('Pilih divisi penempatan...', '');

        $divisi = Divisi::all(['id', 'nama_divisi'])->prepend(['id' => '', 'nama_divisi' => 'Pilih divisi penempatan...'])->toArray();
        array_unshift($divisi, $divisi[0]);
        unset($divisi[1]);

        return response()->json([
            'pendaftaran' => $pendaftaran,
            'divisi' => $divisi,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $cekDivisi = Divisi::find($request->divisi);
            $pendaftaran = Pendaftaran::where($request->uuid)->first();
            $data = [
                'is_approved' => $request->status,
                'keterangan' => $request->keterangan,
            ];

            if($pendaftaran->is_approved == 'Disetujui' && $pendaftaran->is_approved != $request->status) {
                $cekDivisi->increment('kuota');
            }

            if($request->status != 'Disetujui') {
                $data['surat_penerimaan'] = null;
                $data['divisi_id'] = null;
            } else {
                if($cekDivisi->kuota > 0) {
                    $data['divisi_id'] = $request->divisi;
                    $cekDivisi->decrement('kuota');
                } else {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Kuota untuk divisi ini sudah penuh',
                        'title' => 'Info'
                    ]);
                }
            }

            if($request->hasFile('surat')) {
                if($pendaftaran->surat_penerimaan != null) {
                    unlink($pendaftaran->surat_penerimaan);
                }
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
