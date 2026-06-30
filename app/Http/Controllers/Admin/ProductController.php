<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

public function store(Request $request)
    {
        // 1. Proses Validasi
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'required',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Upload Foto
        $path = $request->file('foto_produk')->store('products', 'public');

        // 3. Simpan ke Database
        \App\Models\Product::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'foto_produk' => $path,
        ]);

        // 4. Kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke etalase!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['nama_produk', 'deskripsi', 'harga']);

        if ($request->hasFile('foto_produk')) {
            if ($product->foto_produk) {
                Storage::disk('public')->delete($product->foto_produk);
            }
            $data['foto_produk'] = $request->file('foto_produk')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->foto_produk) {
            Storage::disk('public')->delete($product->foto_produk);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}