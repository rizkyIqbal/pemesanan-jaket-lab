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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Transaction/Index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "jackets" => $jackets = Jacket::all(),
            "sizes" => $sizes = Size::all(),
        ];

        return Inertia::render("Transaction/Create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->size_id == 5) {
            Transaction::create([
                "user_id" => $request->user_id,
                "jacket_id" => $request->jacket_id,
                "size_id" => $request->size_id,
                "custom" => $request->custom,
                "price" => $request->price + 35000,
                "is_paid" => 0,
            ]);
            return redirect()->route("transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
        } else {
            Transaction::create([
                "user_id" => $request->user_id,
                "jacket_id" => $request->jacket_id,
                "size_id" => $request->size_id,
                "custom" => $request->custom,
                "price" => $request->price,
                "is_paid" => 0,
            ]);
            return redirect()->route("transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            "jackets" => $jackets = Jacket::all(),
            "sizes" => $sizes = Size::all(),
            "transaction" => $transaction = Transaction::where("id", $id)->first()
        ];
        return Inertia::render("Admin/Transaction/Edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $path = null;
        if($request->file("image")) {
            $path = Storage::disk("public")->putFile("proof", $request->file("image"));
        }
        Transaction::where("id", $id)->update([
            "proof" => $path,
            "is_paid" => 1,
        ]);
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }
}
