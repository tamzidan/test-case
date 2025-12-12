<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Logika redirect sederhana atau tampilkan view dashboard dengan menu berbeda
        // View 'dashboard' nanti kita sesuaikan menunya dengan @can

        return view('dashboard');
    }
}
