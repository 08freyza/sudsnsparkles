<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'titleStatement' => 'The Best Laundry Web You Have Ever Seen'
        ];
        return view('home', $data);
    }
}
