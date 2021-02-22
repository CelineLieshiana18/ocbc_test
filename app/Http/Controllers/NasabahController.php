<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Bunga;
use Illuminate\Support\Facades\DB;
use Validator;

class NasabahController extends Controller
{
    public function inputDataRekening()
    {
        $data = Nasabah::all();
        return view('rekening')->with('data',$data);
    }

    public function storeRekening(Request $request)
    {
        // dd($request->all());
        // $validatedData = Validator::make($request->all(), [ 
        //     'persenBunga' => 'min:0|max:255',
        //     'plafond' => 'min:1',
        // ]);
        if($request->plafond > 0 && $request->persenBunga >= 0 && $request->persenBunga <= 100){
            $nasabah = new Nasabah();
            $nasabah->no_rekening = $request->noRekening;
            $nasabah->nama = $request->nama;
            $nasabah->tanggal_realisasi = $request->tanggalRealisasi;
            $nasabah->plafond = $request->plafond;
            $nasabah->jangka_waktu = $request->jangkaWaktu;
            $nasabah->persen_bunga = $request->persenBunga;
            $nasabah->save();
            return redirect('/rekening');
        }else{
            $data = Nasabah::all();
            $send = [
                'data'=>$data,
                'errors'=>[
                    ['plafond > 0'],
                    ['persen bunga harus >= 0 dan < 100']
                ]
            ];
            return view('rekening')->with($send);
        }
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
