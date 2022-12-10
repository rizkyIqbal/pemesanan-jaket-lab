<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Jacket\CreateRequest;
use App\Http\Requests\Jacket\UpdateRequest;
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

        $path = null;
        $path2 = null;
        $path3 = null;
        if ($request->file("image")) {
            $path = Storage::disk("public")->putFile("jackets", $request->file("image"));
        }
        if ($request->file("image2")) {
            $path2 = Storage::disk("public")->putFile("jackets", $request->file("image2"));
        }
        if ($request->file("image_size_chart")) {
            $path3 = Storage::disk("public")->putFile("jackets", $request->file("image_size_chart"));
        }


        Jacket::create([
            "name" => $request->name,
            "price" => $request->price,
            "custom_price" => $request->custom_price,
            "image" => $path,
            "image2" => $path2,
            "image_size_chart" => $path3,
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
    public function update(UpdateRequest $request, $id)
    {
        $jacket = Jacket::where("id", $id)->first();
        $path = $jacket->image;
        $path2 = $jacket->image2;
        $path3 = $jacket->image_size_chart;
        if ($request->file("image")) {
            if ($path) {
                Storage::disk("public")->delete($path);
            }
            $path = Storage::disk("public")->putFile("jackets", $request->file("image"));
        }
        if ($request->file("image2")) {
            if ($path2) {
                Storage::disk("public")->delete($path2);
            }
            $path2 = Storage::disk("public")->putFile("jackets", $request->file("image2"));
        }
        if ($request->file("image_size_chart")) {
            if ($path3) {
                Storage::disk("public")->delete($path3);
            }
            $path3 = Storage::disk("public")->putFile("jackets", $request->file("image_size_chart"));
        }

        $jacket->update([
            "name" => $request->name,
            "price" => $request->price,
            "custom_price" => $request->custom_price,
            "image" => $path,
            "image2" => $path2,
            "image_size_chart" => $path3,
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
        $jacket = Jacket::where("id", $id)->first();
        $path = $jacket->image;
        $path2 = $jacket->image2;
        $path3 = $jacket->image_size_chart;
        if ($path && $path2 && $path3) {
            Storage::disk("public")->delete($path);
            Storage::disk("public")->delete($path2);
            Storage::disk("public")->delete($path3);
        }
        $jacket->delete();
        return redirect()->route('admin.jacket.index')->with('success', 'Data Jaket Berhasil Dihapus !');
    }
}
