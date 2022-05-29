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
        $path = null;
        if($request->file("proof")) {
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
            if($request->size_id == 5) {
                Transaction::create([
                    "user_id" => $request->user_id,
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price + 35000,
                    "proof" => $path,
                    "is_paid" => 1,
                ]);
            } else {
                Transaction::create([
                    "user_id" => $request->user_id,
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price,
                    "proof" => $path,
                    "is_paid" => 1,
                ]);
            }
        } else {
            if($request->size_id == 5) {
                Transaction::create([
                    "user_id" => $request->user_id,
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price + 35000,
                    "proof" => $path,
                    "is_paid" => 0,
                ]);
            } else {
                Transaction::create([
                    "user_id" => $request->user_id,
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price,
                    "proof" => $path,
                    "is_paid" => 0,
                ]);
            }
        }
        
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
        $transaction = Transaction::where("id", $id);
        $path = $transaction->proof;
        if($request->file("proof")) {
            if($path) {
                Storage::disk("public")->delete($path);
            }
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
            if($request->size_id == 5) {
                $transaction->update([
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price + 35000,
                    "proof" => $path,
                    "is_paid" = 1,
                ]);
            } else {
                $transaction->update([
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price,
                    "proof" => $path,
                    "is_paid" = 1,
                ]);
            }    
        } else {
            if($request->size_id == 5) {
                $transaction->update([
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price + 35000,
                    "proof" => $path,
                    "is_paid" = 0,
                ]);
            } else {
                $transaction->update([
                    "jacket_id" => $request->jacket_id,
                    "size_id" => $request->size_id,
                    "custom" => $request->custom,
                    "price" => $request->price,
                    "proof" => $path,
                    "is_paid" = 0,
                ]);
            }
        }
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }

    public function destroy($id) {
        $transaction = Transaction::where("id", $id);
        $path = $transaction->proof;
        Storage::disk("public")->delete($path);
        $transaction->delete();
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Dihapus");
    }
}
