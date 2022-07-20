<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Index');
    }

    public function tes()
    {
        return Inertia::render('Admin/tes/Dashboard');
    }
    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
