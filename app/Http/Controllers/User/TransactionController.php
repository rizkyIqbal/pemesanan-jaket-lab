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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has("user_name")) {
            $nim = intval(substr(session("user_name"), 0, 4));
            if ($nim % 2 == 0) {
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
        } else {
            return redirect()->route("user.login");
        }
    }

    public function store(CreateRequest $request)
    {
        // dd($request);
        if (session()->has("user_name")) {
            $nim = intval(substr(session("user_name"), 0, 4));
            if ($nim % 2 == 0) {
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
                "jacket_id" => $jacket->id,
                "size_id" => $request->size,
                // "size_id" => 3,
                "custom" => $request->custom,
                "price" => $price,
            ]);
            return redirect()->route("user.transaction.payment")->with("success", "Data Transaksi Berhasil Ditambahkan !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function payment()
    {
        if (session()->has("user_name")) {
            $user_login = [
                "user_name" => session("user_name"),
                "full_name" => session("full_name")
            ];
            $transaction = Transaction::select("custom", "price", "jackets.name", "sizes.name")->whereColumn("jacket_id", "jackets.id")->whereColumn("size_id", "sizes.id")->where("user_id", session("user_name"))->first();
            return Inertia::render("User/Transaction/Payment");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function receipt()
    {
        if (session()->has("user_name")) {
            return Inertia::render("User/Transaction/Resi");
        } else {
            return redirect()->route("user.login");
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
        $nim = intval(substr(session("user_name"), 0, 4));
        if ($nim % 2 == 0) {
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

    public function destroy()
    {
        $transaction = Transaction::where("user_id", session("user_name"))->first();
        $transaction->delete();
        return redirect()->route("user.transaction.index");
    }
}
