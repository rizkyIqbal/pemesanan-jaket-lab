<?php

namespace App\Http\Controllers;

use App\Models\Jacket;
use App\Models\Size;
use App\Models\Transaction;
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

            $request->session()->put("user_name", $user["user_name"]);
            $request->session()->put("email", $user["email"]);
            $request->session()->put("full_name", $user["full_name"]);

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function testPdf()
    {
        $transaction = Transaction::where("user_id", session("user_name"))->first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf', ["transaction" => $transaction]);
        return $pdf->stream();
    }
}
