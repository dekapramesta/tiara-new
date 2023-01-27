<?php

namespace App\Http\Controllers;

use App\Models\JenisMenu;
use App\Models\Menu;
use App\Models\Pesanan;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    //
    public function index()
    {
        # code...
        $jenis = JenisMenu::all();
        $data = Menu::all();
        session()->forget('cart');
        return view('user.shop', compact('data', 'jenis'));
    }
    public function AddCart(Request $request)
    {
        # code...
        $id = $request->id;
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->jumlah;
        } else {
            $cart[$id] = [
                "quantity" => $request->jumlah,
            ];
        }
        session()->put('cart', $cart);
        return Response()->json($cart);
        // return Response()->json();
    }
    public function Cart()
    {
        # code...
        $data = session('cart');
        $cart = array();
        if ($data != null) {
            foreach ($data as $dt => $detail) {
                $model = Menu::findOrFail($dt)->getAttributes();
                $model['jumlah'] = $detail['quantity'];
                array_push($cart, $model);
            }
        }


        return view('user.cart', compact('cart'));
    }
    public function UpdateCart(Request $request)
    {
        # code...
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function DeleteCart(Request $request)
    {
        # code...
        if ($request->id) {
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return Response()->json($cart);
        }
    }
    public function Buying(Request $request)
    {
        # code...
        $pesanan_diambil = date("Y-m-d H:i:s", strtotime($request->pesanan_diambil));
        // dd($request);
        $data = [
            'ticket' => 'TB' . rand(1000, 9999),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            'pesanan' => $request->pesanan,
            'pesanan_diambil' => $pesanan_diambil,
            'status_admin' => 0,

        ];
        Pesanan::create($data);
        $result =  new PdfController();
        $request->session()->forget('cart');
        return  $result->generatePDF($data);
    }
    public function bayar()
    {
        # code...
        return view('user.pay');
    }

    public function SearchCode(Request $request)
    {
        # code...
        $data = Pesanan::where('ticket', $request->kode)->first();
        if (is_null($data)) {
            return Response()->json(['data' => 'Kosong'], 404);
        } else {
            return Response()->json($data, 200);
        }
    }
    public function cariKode(Request $request)
    {
        # code...
        $data = Pesanan::where('ticket', $request->kode)->first();
        if (is_null($data)) {
            return Response()->json(['data' => 'Kosong'], 404);
        } else {
            $pesanan = array();
            $total = 0;
            $array = json_decode($data->pesanan);
            foreach ($array as $ps) {
                $total += $ps->harga;
                array_push($pesanan, [
                    'id' => $ps->id,
                    'price' => $ps->harga,
                    'quantity' => $ps->jumlah,
                    'name' => $ps->nama
                ]);
            }
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
                    'gross_amount' => $total,
                ),
                'item_details' => $pesanan,



                'customer_details' => array(
                    'first_name' => $data->nama,
                    'phone' => $data->no_wa,
                    'shipping_address' => [
                        'address' => $data->alamat
                    ]
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return Response()->json(['snapToken' => $snapToken, 'id_pesanan' => $data->id], 200);
        }

        // return view('user.pay', compact('snapToken'));
    }
    public function payment_post(Request $request)
    {
        # code...
        $data = Pesanan::find($request->id_pay);
        $data->status = $request->transaction_status;
        $data->order_id = $request->order_id;
        $data->payment_type = $request->payment_type;
        $data->transaction_id = $request->transaction_id;
        $data->status_code = $request->status_code;
        $data->gross_amount = $request->gross_amount;
        $data->save();
        return Response()->json(['message' => 'success'], 200);
    }
}
