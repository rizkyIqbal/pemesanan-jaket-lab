<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $banks = Bank::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(10)->withQueryString();
        return Inertia::render('Admin/Bank/Index', ['banks' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Bank/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Bank::create([
            "bank" => $request->bank,
            "name" => $request->name,
            "account_number" => $request->account_number,
            "generation" => $request->generation
        ]);
        return redirect()->route('admin.bank.index')->with('success', 'Data Bank Berhasil Ditambahkan !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::where('id', $id)->first();
        return Inertia::render('Admin/Bank/Edit', ['bank' => $bank]);
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
        Bank::where("id", $id)->update([
            "bank" => $request->bank,
            "name" => $request->name,
            "account_number" => $request->account_number,
            "generation" => $request->generation
        ]);

        return redirect()->route('admin.bank.index')->with('success', 'Data Bank Berhasil Ditambahkan !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::find($id)->delete();
    }
}
