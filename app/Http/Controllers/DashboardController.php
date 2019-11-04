<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * function untuk menampilkan dashboard
     */
    public function home()
    {
        return view('dashboard.home');
    }
}
