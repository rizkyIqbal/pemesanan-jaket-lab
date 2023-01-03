<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Transaction;
use App\Models\Track;
use App\Models\Stock;
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

    public function update(Request $request, $id, $index)
    {
        $transaction = Transaction::where('id', $id)->first();
        $stock = Stock::where("size_id", $transaction->size_id)->first();
        if($request->track[$index] == 3 && $transaction->order_type == 1){
            Stock::where("size_id", $transaction->size_id)->update([
                "stock" => $stock->stock - 1
            ]);
        }

        $transaction->track_id = $request->track[$index];
        $transaction->save();

        Timeline::create([
            "track_id" => $transaction->track_id,
            "transaction_id" => $transaction->id
        ]);
        return redirect()->route("admin.check.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }
}
