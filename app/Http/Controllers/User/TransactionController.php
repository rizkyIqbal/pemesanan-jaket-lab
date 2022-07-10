<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\Jacket;
use App\Models\Transaction;
use App\Models\Size;
use App\Models\User_Login;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->sizes = Size::all();
        $this->user_login = User_Login::where("id", 1)->first();
        $nim = intval(substr($this->user_login["user_name"], 0, 4));
        if ($nim % 2 == 0) {
            $this->jacket = Jacket::where("id", 2)->first();
        } else {
            $this->jacket = Jacket::where("id", 1)->first();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "jacket" => $this->jacket,
            "sizes" => $this->sizes,
            "user_login" => $this->user_login
        ];
        return Inertia::render("User/Transaction/Index", $data);
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
    public function store(CreateRequest $request)
    {
        $price = $request->price;

        if ($request->size_id == 5) {
            $price += 35000;
        }

        Transaction::create([
            "user_id" => $request->user_id,
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
        if ($request->file("image")) {
            $path = Storage::disk("public")->putFile("proof", $request->file("image"));
        }
        Transaction::where("id", $id)->update([
            "proof" => $path,
            "is_paid" => 1,
        ]);
        return redirect()->route("admin.transaction.index")->with("success", "Data Transaksi Berhasil Diubah !");
    }
}
