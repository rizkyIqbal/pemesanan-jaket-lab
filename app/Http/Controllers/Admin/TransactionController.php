<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\Jacket;
use App\Models\Transaction;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->jackets = Jacket::all();
        $this->sizes = Size::all();
    }

    public function index(Request $request)
    {
        $transactions = Transaction::when($request->has("search"), function ($query) use ($request) {
            $query->where("user_id", "LIKE", "%" . $request->search . "%");
        })->paginate(10)->withQueryString();
        return Inertia::render("Admin/Transaction/Index", ['transactions' => $transactions]);
    }

    public function create()
    {
        $data = [
            "jackets" => $this->jackets,
            "sizes" => $this->sizes,
        ];
        return Inertia::render("Admin/Transaction/Create", $data);
    }

    public function store(CreateRequest $request)
    {
        $jacket = Jacket::where("id", $request->jacket_id)->first();
        $price = $jacket->price;
        $path = null;
        $is_paid = 0;
        if ($request->file("proof")) {
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
            $is_paid = 1;
        }

        if ($request->size_id == 5) {
            $price += 35000;
        }

        Transaction::create([
            "user_id" => $request->user_id,
            "jacket_id" => $jacket->id,
            "size_id" => $request->size_id,
            "custom" => $request->custom,
            "price" => $price,
            "proof" => $path,
            "is_paid" => $is_paid,
        ]);

        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
    }

    public function edit($id)
    {
        $data = [
            "jackets" => $this->jackets,
            "sizes" => $this->sizes,
            "transaction" => Transaction::where("id", $id)->first()
        ];

        // dd(Transaction::where("id", $id)->first());
        return Inertia::render("Admin/Transaction/Edit", $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->jacket_id);
        $transaction = Transaction::where("id", $id)->first();
        $path = $transaction->proof;
        $jacket = Jacket::where("id", $request->jacket_id)->first();
        $price = $jacket->price;
        $is_paid = 0;

        if ($request->file("proof")) {
            if ($path) {
                Storage::disk("public")->delete($path);
            }
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
            $is_paid = 1;
        }

        if ($request->size_id == 5) {
            $price += 35000;
        }

        $transaction->update([
            "user_id" => $request->user_id,
            "jacket_id" => $jacket->id,
            "size_id" => $request->size_id,
            "custom" => $request->custom,
            "price" => $price,
            "proof" => $path,
            "is_paid" => $is_paid,
        ]);

        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }

    public function destroy($id)
    {
        $transaction = Transaction::where("id", $id)->first();
        $path = $transaction->proof;
        Storage::disk("public")->delete($path);
        $transaction->delete();
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Dihapus");
    }
}