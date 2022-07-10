<?php

namespace App\Http\Controllers;

use App\Models\Jacket;
use App\Models\Size;
use App\Models\Transaction;
use App\Models\User_Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Inertia::render('User/Index');
    }

    public function login()
    {
        return Inertia::render('User/LoginUser');
    }

    public function sign_in(Request $request)
    {
        $response = Http::post("https://api.infotech.umm.ac.id/dotlab/api/v1/auth/student", [
            "username" => $request->username,
            "password" => $request->password
        ]);

        if ($response["success"] == true) {
            $user = Http::withToken($response["access_token"])->post('https://api.infotech.umm.ac.id/dotlab/api/v1/auth/me');

            $this->user_login->update([
                "user_name" => $user["user_name"],
                "email" => $user["email"],
                "full_name" => $user["full_name"]
            ]);

            return redirect()->route("user.index");
        } else {
            return redirect()->route("user.login");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "jacket" => $this->jacket,
            "sizes" => $this->sizes,
            "user_login" => $this->user_login
        ];

        // return Inertia::render("", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = $this->jacket->price;
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
            "user_id" => $this->user_login["user_name"],
            "jacket_id" => $this->jacket->id,
            "size_id" => $request->size_id,
            "custom" => $request->custom,
            "price" => $price,
            "proof" => $path,
            "is_paid" => $is_paid
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            "jackets" => $this->jackets,
            "sizes" => $this->sizes,
            "user_login" => $this->user_login,
            "transaction" => Transaction::where("id", $id)->first()
        ];

        // return Inertia::render("", $data);
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
        $transaction = Transaction::where("id", $id)->first();
        $path = $transaction->proof;
        $price = $this->jacket->price;
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
            "user_id" => $this->user_login["user_name"],
            "jacket_id" => $this->jacket->id,
            "size_id" => $request->size_id,
            "custom" => $request->custom,
            "price" => $price,
            "proof" => $path,
            "is_paid" => $is_paid,
        ]);
    }

    public function testPdf()
    {
        $transaction = Transaction::where("user_id", $this->user_login["user_name"])->first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf', ["transaction" => $transaction]);
        return $pdf->stream();
    }
}
