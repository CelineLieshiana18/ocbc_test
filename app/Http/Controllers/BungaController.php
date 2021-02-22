<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bunga;

class BungaController extends Controller
{
    public function perubahanBunga()
    {
        $data = Bunga::all();
        return view('perubahan_bunga')->with('data',$data);
    }

    public function storeBunga(Request $request)
    {
        $validatedData = $request->validate([
            'persenBunga' => ['required', 'min:0', 'max:100'],
        ]);
        $bunga = new Bunga();
        $bunga->no_rekening = $request->noRekening;
        $bunga->tanggal_perubahan_bunga = $request->tanggalPerubahanBunga;
        $bunga->persen_bunga = $request->persenBunga;
        $bunga->save();
        return redirect('/perubahanbunga');
    }
}
