<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function inputDataRekening()
    {
        return view('rekening');
    }
}
