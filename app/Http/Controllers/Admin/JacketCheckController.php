<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class JacketCheckController extends Controller
{
    public function index(Request $request) {
        $transactions = Transaction::when($request->has("search"), function ($query) use ($request) {
            $query->where("user_id", "LIKE", "%" . $request->search . "%");
        })->paginate(10)->withQueryString();
        return Inertia::render("Admin/Transaction/Index", ['transactions' => $transactions]);
    }
}
