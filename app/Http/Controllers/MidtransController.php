<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Ig6Wl9OM0qoOqbCASQLyloQ6';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user.tes', compact('snapToken'));
    }
    public function midtransCall(Request $request)
    {
        # code...
        $data = json_decode($request->getContent());
        $signatureKey = hash('sha512', $data->order_id . $data->status_code . $data->gross_amount . 'SB-Mid-server-Ig6Wl9OM0qoOqbCASQLyloQ6');
        if ($signatureKey != $data->signature_key) {
            return abort(404);
        }
        $order = Pesanan::where('order_id', $data->order_id)->first();
        $order->update(['status' => $data->transaction_status, 'status_code' => $data->status_code]);
        return response()->json(['Message' => "success"], 200);
    }
}
