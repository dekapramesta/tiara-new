<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $data = Menu::all();
        // dd($data);
        return view('admin.dashboard', compact('data'));
    }
}
