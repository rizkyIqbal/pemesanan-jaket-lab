<?php

namespace App\Http\Controllers;

use App\Models\Countdown;
use App\Models\Jacket;
use App\Models\Size;
use App\Models\Transaction;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
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

        $countdowns = Countdown::pluck('finish_at');
        return Inertia::render('User/Index', ['countdowns' => $countdowns]);
    }

    public function login()
    {
        if (session()->has("user_name")) {
            return redirect()->route("user.index");
        } else {
            return Inertia::render('User/LoginUser');
        }
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
            $request->session()->put("access_token", $response["access_token"]);

            return redirect()->route("user.index");
        } else {
            return redirect()->route("user.login");
        }
    }

    public function logout()
    {
        // if(session()->has("user_name")) {
        //     $response = Http::withToken(session("access_token"))->post('https://api.infotech.umm.ac.id/dotlab/api/v1/auth/logout');

        //     if($response["message"] != "Unauthorized") {
        //         session()->flush();
        //         return redirect()->route("user.index");
        //     } else {
        //         return redirect()->route("user.login");
        //     }
        // } else {

        // }
        $response = Http::withToken(session("access_token"))->post('https://api.infotech.umm.ac.id/dotlab/api/v1/auth/logout');

        if ($response["message"] != "Unauthorized") {
            session()->flush();
            return redirect()->route("user.login");
        } else {
            return redirect()->route("user.index");
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

    public function about()
    {
        return Inertia::render('User/About');
    }
}
