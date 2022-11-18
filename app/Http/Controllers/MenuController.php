<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function TambahMenu(Request $request)
    {
        # code...
        $validate = $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);

        // $name = str_replace(' ', '_', $request->file('gambar')->getClientOriginalName());
        $name = $request->gambar->hashName();

        $request->file('gambar')->move(public_path('image'), $name);


        $save = new Menu();
        $save->nama = $request->nama;
        $save->harga = $request->harga;
        $save->jenis = $request->jenis;
        $save->deskripsi = $request->deskripsi;
        $save->gambar = $name;
        $save->save();
        return redirect()->back();
    }
    public function UpdateMenu(Request $request)
    {
        # code...
        $data = Menu::find($request->id);
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->jenis = $request->jenis;
        $data->deskripsi = $request->deskripsi;

        if ($request->gambar != null) {
            unlink(public_path('image/' . $data->gambar));
            // $name = str_replace(' ', '_', $request->file('gambar')->getClientOriginalName());
            $name = $request->gambar->hashName();

            $request->file('gambar')->move(public_path('image'), $name);
            $data->gambar = $name;
        }
        $data->save();
        return redirect()->back();
    }
    public function DeleteMenu($id)
    {
        # code...
        $data = Menu::find($id);
        if (file_exists(public_path('image/' . $data->gambar))) {
            unlink(public_path('image/' . $data->gambar));
        }
        $data->delete();
        return redirect()->back();
    }
}
