<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(produk::latest()->get(),200);
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

        $request->validate([
            'nama' => 'required',
             'harga' => 'required',
              'stok' => 'required',
               'desk' => 'required',
        ]);
        $produk=produk::create([
        'nama'=>$request->nama,
          'harga'=>$request->harga,
            'stok'=>$request->stok,
              'desk'=>$request->desk,
                'gambar'=>''
        ]);
        return response()->json([
            'message'=>'data berhasil di tambahkan',
            'data' =>$produk
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk=produk::find($id);
        if(!$produk){
            return response()->json([
                'massage'=> 'data tidak ada'
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Cari produk berdasarkan ID bertipe bigint dari database suki Anda
    $produk = produk::find($id);

    if (!$produk) {
        return response()->json([
            'status' => 'error',
            'message' => 'Produk dengan ID ' . $id . ' tidak ditemukan di database suki!'
        ], 404);
    }

    $produk->nama = $request->nama;
    $produk->harga = $request->harga;
    $produk->stok = $request->stok;
    $produk->desk = $request->desk;
    $produk->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Produk berhasil diperbarui menggunakan ID Primary Key'
    ], 200);
}


   /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id) 
{

    $produk = produk::find($id);


    if (!$produk) {
        return response()->json([
            'status' => 'error',
            'message' => 'data tidak ada'
        ], 404);
    }


    $produk->delete();


    return response()->json([
        'status' => 'success',
        'message' => 'data berhasil d hps'
    ], 200); // Pastikan statusnya 200 murni
}

}
