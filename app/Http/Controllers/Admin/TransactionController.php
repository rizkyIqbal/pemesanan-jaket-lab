<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Http\Requests\Transaction\UpdateRequest;
use App\Models\Jacket;
use App\Models\Size;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TransactionController extends Controller
{

    private Collection $sizes;
    private Collection $jackets;

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
        if ($request->file("proof")) {
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
        }

        if ($request->custom != null) {
            $size = 0;
            $price += 35000;
        } else {
            $size = $request->size_id;
        }

        if ($request->approve == 1) {
            $paid = 1;
        } else if ($request->approve == 0) {
            $paid = 0;
        }

        Transaction::create([
            "user_id" => $request->user_id,
            "jacket_id" => $jacket->id,
            "size_id" => $size,
            "custom" => $request->custom,
            "price" => $price,
            "proof" => $path,
            // "status" => $request->status,
            "is_paid" => $paid,
        ]);

        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
    }

    public function edit($id)
    {
        $transactions = Transaction::where("id", $id)->first();
        return Inertia::render("Admin/Transaction/Edit", ['transaction' => $transactions]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $transaction = Transaction::where("id", $id)->first();
        $path = $transaction->proof;
        $jacket = Jacket::where("id", $transaction->jacket_id)->first();
        $price = $jacket->price;

        if ($request->file("proof")) {
            if ($path) {
                Storage::disk("public")->delete($path);
            }
            $path = Storage::disk("public")->putFile("transaction", $request->file("proof"));
        }

        if ($request->custom != null) {
            $size = 0;
            $price += 35000;
        } else {
            $size = $request->size_id;
        }

        if ($request->approve == 1) {
            $paid = 1;
        } else if ($request->approve == 0) {
            $paid = 0;
        }

        $transaction->update([
            "user_id" => $request->user_id,
            "jacket_id" => $jacket->id,
            "size_id" => $size,
            "custom" => $request->custom,
            // "status" => $request->status,
            "price" => $price,
            "proof" => $path,
        ]);

        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }

    public function destroy($id)
    {
        $transaction = Transaction::where("id", $id)->first();
        $path = $transaction->proof;
        if ($path) {

            Storage::disk("public")->delete($path);
        }
        $transaction->delete();
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Dihapus");
    }
}
