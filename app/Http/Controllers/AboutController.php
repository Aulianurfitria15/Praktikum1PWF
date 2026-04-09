<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Menampilkan halaman biodata (About).
     */
    public function about(): View
    {
        return view('about');
    }
}