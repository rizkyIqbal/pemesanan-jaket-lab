<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Timeline;
use App\Models\Track;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Inertia\Inertia;


class JacketCheckController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::when($request->has("search"), function ($query) use ($request) {
            $query->where("user_id", "LIKE", "%" . $request->search . "%");
        })->with('track')->paginate(10)->withQueryString();
        $tracks = Track::get();
        return Inertia::render("Admin/Check/Index", ['transactions' => $transactions, 'tracks' => $tracks]);
    }

    public function update(Request $request, $id, TransactionService $transactionService)
    {
        $transactionService->changeStatus($id, $request->track_id);
        return redirect()->route("admin.check.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }

}
