<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function index()
    {
        # code...
        $data = About::all();
        return view('admin.about', compact('data'));
    }
    public function TambahAbout(Request $request)
    {
        # code...
        $request->validate([
            'title_kelebihan' => 'required',
            'desk_kelebihan' => 'required',

        ]);

        $data = new About($request->all());
        $data->save();
        return redirect()->back();
    }
    public function EditAbout(Request $request)
    {
        # code...
        $data = About::find($request->id);
        $data->title_kelebihan = $request->title_kelebihan;
        $data->desk_kelebihan = $request->desk_kelebihan;
        $data->save();
        return redirect()->back();
    }
    public function DeleteAbout($id)
    {
        # code...
        // dd($id);
        $data = About::find($id);
        $data->delete();
        return redirect()->back();
    }
}
