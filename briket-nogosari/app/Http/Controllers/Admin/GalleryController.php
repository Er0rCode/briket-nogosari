<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('foto')->store('gallery', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'foto' => $path
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->foto) {
            Storage::disk('public')->delete($gallery->foto);
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}