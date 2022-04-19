<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Jacket\CreateRequest;
use App\Models\Jacket;
use Inertia\Inertia;

class JacketController extends Controller
{
    public function index(Request $request)
    {
        $jackets = Jacket::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(10)->withQueryString();
        return Inertia::render('Admin/Jacket/Index', ['jackets' => $jackets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Jacket/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        Jacket::create([
            'name' => $request->name,
            "image" => $request->image,
            "color" => $request->color,
            "price" => $request->price,
        ]);
        return redirect()->route('admin.jacket.index')->with('success', 'Data Jaket Berhasil Ditambahkan !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jacket = Jacket::where('id', $id)->first();
        return Inertia::render('Admin/Jacket/Edit', ['jacket' => $jacket]);
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
        Jacket::where("id", $id)->update([
            'name' => $request->name,
            "image" => $request->image,
            "color" => $request->color,
            "price" => $request->price,
        ]);
        return redirect()->route('admin.jacket.index')->with('success', 'Data Jaket Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jacket::find($id)->delete();
        return redirect()->route('admin.jacket.index')->with('success', 'Data Jaket Berhasil Dihapus !');
    }
}
