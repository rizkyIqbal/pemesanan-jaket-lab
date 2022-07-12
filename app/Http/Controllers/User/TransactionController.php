<?php

namespace App\Http\Controllers\User;

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
        $this->sizes = Size::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = intval(substr(session("user_name"), 0, 4));
        if($nim % 2 == 0) {
            $jacket = Jacket::where("id", 2)->first();
        } else {
            $jacket = Jacket::where("id", 1)->first();
        }
        $sizes = $this->sizes;
        $user_login = [
            "user_name" => session("user_name"),
            "full_name" => session("full_name")
        ];
        return Inertia::render("User/Transaction/Index", ['jacket' => $jacket, 'sizes' => $sizes, 'user_login' => $user_login]);
    }

    public function payment()
    {
        return Inertia::render("User/Transaction/Payment");
    }

    public function receipt()
    {
        return Inertia::render("User/Transaction/Resi");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nim = intval(substr(session("user_name"), 0, 4));
        if($nim % 2 == 0) {
            $jacket = Jacket::where("id", 2)->first();
        } else {
            $jacket = Jacket::where("id", 1)->first();
        }
        $sizes = $this->sizes;
        $user_login = [
            "user_name" => session("user_name"),
            "full_name" => session("full_name")
        ];

        return Inertia::render("Transaction/Create", ['jacket' => $jacket, 'sizes' => $sizes, 'user_login' => $user_login]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $nim = intval(substr(session("user_name"), 0, 4));
        if($nim % 2 == 0) {
            $jacket = Jacket::where("id", 2)->first();
        } else {
            $jacket = Jacket::where("id", 1)->first();
        }
        $price = $jacket->price;

        if ($request->size_id == 5) {
            $price += 35000;
        }

        Transaction::create([
            "user_id" => session("user_name"),
            "jacket_id" => $request->jacket_id,
            "size_id" => $request->size_id,
            "custom" => $request->custom,
            "price" => $price,
            "is_paid" => 0,
        ]);
        return redirect()->route("transaction.index")->with("success", "Data Transaksi Berhasil Ditambahkan !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nim = intval(substr(session("user_name"), 0, 4));
        if($nim % 2 == 0) {
            $jacket = Jacket::where("id", 2)->first();
        } else {
            $jacket = Jacket::where("id", 1)->first();
        }
        $sizes = Size::all();
        $transaction = Transaction::where("id", $id)->first();

        return Inertia::render("Admin/Transaction/Edit", ['jacket' => $jacket, 'sizes' => $sizes, 'transaction' => $transaction]);
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
        if ($request->file("image")) {
            $path = Storage::disk("public")->putFile("proof", $request->file("image"));
        }
        Transaction::where("id", $id)->update([
            "proof" => $path,
            "status" => 2,
            "is_paid" => 1,
        ]);
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }
}
