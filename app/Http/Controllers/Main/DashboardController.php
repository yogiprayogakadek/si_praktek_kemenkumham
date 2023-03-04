<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Sunra\PhpSimple\HtmlDomParser;
use \DOMDocument;
use \DOMXPath;
use Symfony\Component\DomCrawler\Crawler;
class DashboardController extends Controller
{
    public function index()
    {
        $divisi = Divisi::where('status', true)->pluck('nama_divisi', 'uuid')->prepend('Pilih divisi ...', '');

        return view('index')->with([
            'divisi' => $divisi
        ]);
    }

    public function chart($kategori, $jumlah)
    {
        if($kategori == 'divisi') {
            $data = DB::table('pendaftaran')
                ->join('divisi', 'pendaftaran.divisi_id', 'divisi.id')
                ->select(DB::raw('divisi.nama_divisi as label'), DB::raw('COUNT(*) as value'))
                ->where('pendaftaran.is_approved', 'Disetujui')
                ->groupBy('pendaftaran.divisi_id')
                ->get()->take($jumlah == 'semua' ? 100 : $jumlah);
        } else {
            $data = DB::table('pendaftaran')
                ->join('mahasiswa', 'pendaftaran.mahasiswa_id', 'mahasiswa.id')
                ->select(DB::raw('mahasiswa.asal_sekolah as label'), DB::raw('COUNT(*) as value'))
                ->where('pendaftaran.is_approved', 'Disetujui')
                ->groupBy('pendaftaran.mahasiswa_id')
                ->get()->take($jumlah == 'semua' ? 100 : $jumlah);
        }

        return response()->json($data);
    }

    public function divisi($uuid)
    {
        $data = Divisi::where('uuid', $uuid)->first();

        return response()->json($data);
    }
}
