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
            $transaction = Transaction::where("user_id", $user_login["user_name"])->first();
            $jacket = Jacket::where("id", $transaction["jacket_id"])->first();
            $size = Size::where("id", $transaction["size_id"])->first();
            return Inertia::render("User/Transaction/Payment", ['jackets' => $jacket, 'sizes' => $size, 'user_logins' => $user_login, "transactions" => $transaction]);
        } else {
            return redirect()->route("user.login");
        }
    }

    public function store_payment(Request $request)
    {
        if (session()->has("user_name")) {
            // dd($request->bank);
            if ($request->bank == "BCA") {
                $bank = "Bank Central Asia";
            } else if ($request->bank == "BRI") {
                $bank = "Bank Rakyat Indonesia";
            } else if ($request->bank == "Mandiri") {
                $bank = "Bank Mandiri";
            }
            Transaction::where("user_id", session("user_name"))->update([
                "bank" => $bank,
                "status" => 2,
            ]);
            return redirect()->route("user.transaction.receipt")->with("success", "Data Transaksi Berhasil Diubah !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function receipt()
    {
        if (session()->has("user_name")) {
            $user_login = [
                "user_name" => session("user_name"),
                "full_name" => session("full_name")
            ];
            $transaction = Transaction::where("user_id", $user_login["user_name"])->first();
            $jacket = Jacket::where("id", $transaction["jacket_id"])->first();
            $size = Size::where("id", $transaction["size_id"])->first();
            return Inertia::render("User/Transaction/Resi", ['jackets' => $jacket, 'sizes' => $size, 'user_logins' => $user_login, "transactions" => $transaction]);
        } else {
            return redirect()->route("user.login");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_receipt(Request $request)
    {
        if(session()->has("user_name")) {
            $path = null;
            if ($request->file("image")) {
                $path = Storage::disk("public")->putFile("proof", $request->file("image"));
            }
            Transaction::where("user_id", session("user_name"))->update([
                "proof" => $path,
                "status" => 3,
            ]);
            return redirect()->route("user.transaction.receipt")->with("success", "Data Transaksi Berhasil Diubah !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function destroy()
    {
        $transaction = Transaction::where("user_id", session("user_name"))->first();
        $transaction->delete();
        return redirect()->route("user.transaction.index");
    }
}
