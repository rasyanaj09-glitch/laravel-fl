<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        return response()->json(Produk::latest()->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'desk' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk = Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'desk' => $request->desk,
            'gambar' => $gambar,
        ]);

        return response()->json([
            'message' => 'data berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'message' => 'data tidak ada'
            ], 404);
        }

        return response()->json($produk, 200);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk dengan ID ' . $id . ' tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'desk' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->desk = $request->desk;

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk
        ], 200);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak ada'
            ], 404);
        }

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ], 200);
    }
}
