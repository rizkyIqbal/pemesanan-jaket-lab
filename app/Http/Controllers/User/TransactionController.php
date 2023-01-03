<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\Bank;
use App\Models\Jacket;
use App\Models\Timeline;
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
    public function index($id)
    {
        if (session()->has("user_name")) {
            $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
            if ($transaction == null || $transaction->status == 4) {
                $nim = intval(substr(session("user_name"), 0, 4));
                $jacket = Jacket::first();
                $sizes = $this->sizes;
                $user_login = [
                    "user_name" => session("user_name"),
                    "full_name" => session("full_name")
                ];
                return Inertia::render("User/Transaction/Index", ['jacket' => $jacket, 'sizes' => $sizes, 'user_login' => $user_login, "id" => $id]);
            } else if ($transaction->status == 1) {
                return redirect()->route("user.transaction.payment", $id);
            } else if ($transaction->status == 2 || $transaction->status == 3) {
                return redirect()->route("user.transaction.receipt", $id);
            }
        } else {
            return redirect()->route("user.login");
        }
    }

    public function store(CreateRequest $request, $id)
    {
        if (session()->has("user_name")) {
            $nim = intval(substr(session("user_name"), 0, 4));
            if ($nim % 2 == 0) {
                $jacket = Jacket::where("id", 2)->first();
            } else {
                $jacket = Jacket::where("id", 1)->first();
            }
            $price = $jacket->price;

            if ($request->a != null && $request->b != null && $request->c != null) {
                $custom = "A : $request->a cm B : $request->b cm C : $request->c cm";
                $size = 0;
                if ($request->a > 80 || $request->b > 80 || $request->c > 80) {
                    $price += 10000;
                }
            } else {
                $custom = null;
                $size = $request->size;
            }

            $transaction = Transaction::create([
                "user_id" => session("user_name"),
                "jacket_id" => $jacket->id,
                "size_id" => $size,
                "custom" => $custom,
                "price" => $price,
                "bank_id" => null,
                "transfer_from" => null,
                "proof" => null,
                "track_id" => 1,
                "phone_number" => $request->phone,
                "order_type" => $id
            ]);

            Timeline::create([
                "track_id" => 1,
                "transaction_id" => $transaction->id
            ]);

            return redirect()->route("user.transaction.payment", $id)->with("success", "Data Transaksi Berhasil Ditambahkan !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function payment($id)
    {
        if (session()->has("user_name")) {
            $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
            if ($transaction == null || $transaction->status == 4) {
                return redirect()->route("user.transaction.index", $id);
            } else if ($transaction->status == 1) {
                $user_login = [
                    "user_name" => session("user_name"),
                    "full_name" => session("full_name")
                ];
                $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
                $jacket = Jacket::where("id", $transaction["jacket_id"])->first();
                if ($transaction->custom != null) {
                    $size = $transaction->custom;
                } else {
                    $size = Size::where("id", $transaction["size_id"])->first();
                }

                $nim = intval(substr(session("user_name"), 0, 4));
                $bank = Bank::where("generation", $nim)->get();

                return Inertia::render("User/Transaction/Payment", ['jackets' => $jacket, 'sizes' => $size, 'user_logins' => $user_login, "transactions" => $transaction, "banks" => $bank, 'id' => $id]);
            } else if ($transaction->status == 2 || $transaction->status == 3) {
                return redirect()->route("user.transaction.receipt", $id);
            }
        } else {
            return redirect()->route("user.login");
        }
    }

    public function store_payment(Request $request, $id)
    {
        if (session()->has("user_name")) {
            $transaction = Transaction::where([["user_id", session("user_name")], ["id", $request->id]])->update([
                "bank_id" => $request->bank,
                "status" => 2,
            ]);
            return redirect()->route("user.transaction.receipt", $id)->with("success", "Data Transaksi Berhasil Diubah !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function receipt($id)
    {
        if (session()->has("user_name")) {
            $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
            if ($transaction == null || $transaction->status == 4) {
                return redirect()->route("user.transaction.index");
            } else if ($transaction->status == 1) {
                return redirect()->route("user.transaction.payment");
            } else if ($transaction->status == 2 || $transaction->status == 3) {
                $user_login = [
                    "user_name" => session("user_name"),
                    "full_name" => session("full_name")
                ];
                $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
                $jacket = Jacket::where("id", $transaction["jacket_id"])->first();
                if ($transaction->custom != null) {
                    $size = $transaction->custom;
                } else {
                    $size = Size::where("id", $transaction["size_id"])->first();
                }

                $bank = Bank::where("id",  $transaction["bank_id"])->first();

                return Inertia::render("User/Transaction/Resi", ['jackets' => $jacket, 'sizes' => $size, 'user_logins' => $user_login, "transactions" => $transaction, "banks" => $bank, 'id' => $id]);
            }
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
    public function store_receipt(Request $request, $id)
    {
        if (session()->has("user_name")) {
            $path = null;
            if ($request->file("image")) {
                $path = Storage::disk("public")->putFile("proof", $request->file("image"));
            }
            $transaction = Transaction::where([["user_id", session("user_name")], ["id", $request->id]])->first();
            $transaction->proof = $path;
            $transaction->status = 3;
            $transaction->transfer_from = $request->sender;
            $transaction->track_id = 2;
            $transaction->save();
            Timeline::create([
                "track_id" => 2,
                "transaction_id" => $transaction->id
            ]);

            return redirect()->route("user.transaction.receipt" , $id)->with("success", "Data Transaksi Berhasil Diubah !");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function create_new_order($id)
    {
        if (session()->has("user_name")) {
            Transaction::where("user_id", session("user_name"))->update([
                "status" => 4,
            ]);
            return redirect()->route("user.transaction.index",$id);
        } else {
            return redirect()->route("user.login");
        }
    }

    public function destroy($id)
    {
        $transaction = Transaction::where("user_id", session("user_name"))->latest()->first();
        $transaction->delete();
        return redirect()->route("user.transaction.index", $id);
    }
}
