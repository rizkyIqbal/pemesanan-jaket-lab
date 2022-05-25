<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Size\CreateRequest;
use App\Models\Size;
use Inertia\Inertia;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes = Size::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(10)->withQueryString();
        return Inertia::render("Admin/Size/Index", ["sizes" => $sizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Admin/Size/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Size::create([
            "name" => $request->name,
            "a" => $request->a,
            "b" => $request->b,
            "c" => $request->c
        ]);
        return redirect()->route("admin.size.index")->with('success', 'Data Ukuran Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::where("id", $id)->first();
        return Inertia::render("Admin/Size/Edit", ["size" => $size]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::where("id", $id)->first();
        return Inertia::render("Admin/Size/Edit", ["size" => $size]);
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
        Size::where("id", $id)->update([
            "name" => $request->name,
            "a" => $request->a,
            "b" => $request->b,
            "c" => $request->c
        ]);
        return redirect()->route("admin.size.index")->with("success", "Data ukuran berhasil diubah !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::find($id)->delete();
        return redirect()->route("admin.size.index")->with("success", "Data ukuran berhasil dihapus!");
    }
}
