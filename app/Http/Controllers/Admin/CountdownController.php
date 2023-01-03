<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountdownController extends Controller
{
    public function index() {
        $countdowns = Bank::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(10)->withQueryString();
        // return
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        Countdown::create([
            "name" => $request->name,
            "started_at" => $request->started_at,
            "finish_at" => $request->finish_at
        ]);
        // return redirect()
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        Countdown::where("id", $id)->update([
            "name" => $request->name,
            "started_at" => $request->started_at,
            "finish_at" => $request->finish_at
        ]);
        // return redirect()
    }

    public function destroy($id) {
        Countdown::find($id)->delete();
    }
}
