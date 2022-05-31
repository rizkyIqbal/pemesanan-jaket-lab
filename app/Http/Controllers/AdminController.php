<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
