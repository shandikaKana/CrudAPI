<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::all();
        if ($kategori->isEmpty()) {
            return response()->json([
                'status' => false,
                'msg' => 'Kategori Belum Ada'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'List Data Kategori',
                'data' => $kategori
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'dkr' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $kategori = kategori::create($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Data Berhasil Di Simpan',
            'data' => $kategori
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = kategori::find($id);
        if ($kategori == null) {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Ditemukan'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'List Detail Kategori',
                'data' => $kategori
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'dkr' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $kategori = kategori::find($id);
        if ($kategori == null) {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Ditemukan'
            ]);
        } else {
            $kategori->update($request->all());
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Di Ubah',
                'data' => $kategori
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id);
        if ($kategori == null) {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Ditemukan'
            ]);
        } else {
            $kategori->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Di Hapus',
                'data' => $kategori
            ]);
        }
    }
}
