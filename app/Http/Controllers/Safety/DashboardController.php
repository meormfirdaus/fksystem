<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('safety.dashboard');
    }
}
