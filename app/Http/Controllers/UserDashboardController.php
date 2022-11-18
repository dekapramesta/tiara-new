<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        $data = Menu::all();
        return view('user.dashboard', compact('data'));
    }
}
