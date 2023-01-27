<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    //
    public function generatePDF($val)
    {

        $val['pesanan'] = json_decode($val['pesanan']);
        $val['tanggal'] = Carbon::now();
        // return response()->json($val['pesanan'], 200);

        $pdf = PDF::loadView('/user/invoice', $val);

        return $pdf->download('invoice-tiarabakery.pdf');
    }
}
