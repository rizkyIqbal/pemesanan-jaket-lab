<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\Jacket;
use App\Models\Transaction;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index(Request $request) {
        // $transactions = Transaction::when($request->has("search"), function($query) use($request) {
        //     $query->where("user_id", "LIKE", "%" . $request->search . "%");
        // })->paginate(10)->withQueryString();
        return Inertia::render("Admin/Transaction/Index");
    }

    public function create() {
        $data = [
            "jackets" => $jackets = Jacket::all(),
            "sizes" => $sizes = Size::all(),
        ];
        return Inertia::render("Admin/Transaction/Create", $data);
    }

    public function store(CreateRequest $request) {
        Transaction::create([
            "user_id" => $request->user_id,
            "jacket_id" => $request->jacket_id,
            "size_id" => $request->size_id,
            "order_type" => $request->order_type,
            "custom" => $request->custom,
            "price" => $request->price,
            "proof" => $request->proof,
        ]);
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
    }

    public function edit($id) {
        $data = [
            "jackets" => $jackets = Jacket::all(),
            "sizes" => $sizes = Size::all(),
            "transaction" => $transaction = Transaction::where("id", $id)->first()
        ];
        return Inertia::render("Admin/Transaction/Edit", $data);
    }

    public function update(Request $request, $id) {
        Transaction::where("id", $id)->update([
            "user_id" => $request->user_id,
            "jacket_id" => $request->jacket_id,
            "size_id" => $request->size_id,
            "order_type" => $request->order_type,
            "custom" => $request->custom,
            "price" => $request->price,
            "proof" => $request->proof,
        ]);
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }

    public function destroy($id) {
        Transaction::find($id)->delete();
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Dihapus");
    }
}
