<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 各リストを取得

        return view('home', [
            'title' => 'Home',
            'description' => 'This is the home page.',
        ]);
    }
}
