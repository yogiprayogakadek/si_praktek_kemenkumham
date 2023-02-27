<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;
use Ramsey\Uuid\Uuid;

class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request)
    {
        try {
            $salt = env('SALT_CODE');
            $uuid = $uuid = Hash::make($salt . Uuid::uuid4()->toString() . $salt);
            DB::transaction(function () use ($request, $salt, $uuid) {
                if($request->hasFile('foto')) {
                    $filenamewithextension = $request->file('foto')->getClientOriginalName();
                    $extension = $request->file('foto')->getClientOriginalExtension();

                    $filenametostore = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $extension;
                    $save_path = 'assets/uploads/users/';

                    if (!file_exists($save_path)) {
                        mkdir($save_path, 666, true);
                    }
                }
                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(300, 300);
                $img->save($save_path . $filenametostore);


                $user = User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'role' => 'Mahasiswa',
                    'foto' => $save_path . $filenametostore,
                    'uuid' => preg_replace('/[\/\\\\]/', '', $uuid)
                ]);

                $mahasiswa = Mahasiswa::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'asal_sekolah' => $request->asal_sekolah,
                    'uuid' => preg_replace('/[\/\\\\]/', '', $uuid)
                    // 'foto' => $save_path . $filenametostore,
                ]);


                if($request->hasFile('dokumen')) {
                    $filenamewithextension = $request->file('dokumen')->getClientOriginalName();
                    $extension = $request->file('dokumen')->getClientOriginalExtension();

                    $filenametostore = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $extension;
                    $save_path = 'assets/uploads/pendaftaran/';

                    if (!file_exists($save_path)) {
                        mkdir($save_path, 666, true);
                    }

                    $request->file('dokumen')->move($save_path, $filenametostore);

                    // $img = Image::make($request->file('dokumen')->getRealPath());
                    // $img->save($save_path . $filenametostore);

                    Pendaftaran::create([
                        'mahasiswa_id' => $mahasiswa->id,
                        // 'no_surat' => $request->no_surat,
                        'dokumen' => $save_path . $filenametostore,
                        'tanggal_pendaftaran' => date('Y-m-d'),
                        'masa_magang' => $request->tanggal_awal . ' s/d ' . $request->tanggal_akhir,
                        'is_approved' => 'Menunggu Konfirmasi',
                        'uuid' => preg_replace('/[\/\\\\]/', '', $uuid)
                    ]);
                }
            });
            // session(['success' => 'Pendaftaran berhasil']);
            // return redirect()->route('main');
            return redirect()->back()->with([
                'message' => 'Pendaftaran berhasil',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'status' => 'error',
            ]);
            // return $e->getMessage();
            // return redirect()->route('main')->with('error', 'Pendaftaran gagal');
        }
    }
}
