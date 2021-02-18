<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Bunga;
use Illuminate\Support\Facades\DB;

class NasabahController extends Controller
{
    public function inputDataRekening()
    {
        $data = Nasabah::all();
        return view('rekening')->with('data',$data);
    }

    public function storeRekening(Request $request)
    {
        $nasabah = new Nasabah();
        $nasabah->no_rekening = $request->noRekening;
        $nasabah->nama = $request->nama;
        $nasabah->tanggal_realisasi = $request->tanggalRealisasi;
        $nasabah->plafond = $request->plafond;
        $nasabah->jangka_waktu = $request->jangkaWaktu;
        $nasabah->persen_bunga = $request->persenBunga;
        $nasabah->save();
        return redirect('/rekening');
    }


    public function angsuran()
    {
        $send = [
            'data'=>0,
            'bunga'=>null,
            'nama'=>null,
            'plafond'=>null,
            'jangkaWaktu'=>null,
            'persenBunga'=>null,
            'noRekening'=>null,
            'angsuranTotal'=>0,
            'tanggalRealisasi'=>null
        ];
        return view('perhitungan_angsuran')->with($send);
    }

    public function lihatAngsuran(Request $request)
    {
        $bunga = DB::table('bungas')
            ->where('bungas.no_rekening', '=', $request->noRekening)
            ->get();
        $pinjaman = DB::table('nasabahs')
            ->where('nasabahs.no_rekening', '=', $request->noRekening)
            ->get();
        $send = [
            'data'=>1,
            'bunga'=>$bunga,
            'nama'=>$pinjaman[0]->tanggal_realisasi,
            'plafond'=>$pinjaman[0]->plafond,
            'jangkaWaktu'=>$pinjaman[0]->jangka_waktu,
            'persenBunga'=>$pinjaman[0]->persen_bunga,
            'noRekening'=>$pinjaman[0]->no_rekening,
            'tanggalRealisasi'=>$pinjaman[0]->tanggal_realisasi
        ];
        return view('perhitungan_angsuran')->with($send);
    }
}
