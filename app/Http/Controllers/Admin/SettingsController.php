<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function editProfile()
    {
        $profile = Profile::firstOrCreate([]);
        return view('admin.settings.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = Profile::first();
        $request->validate([
            'nama_usaha' => 'required',
            'deskripsi_usaha' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto_usaha' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['nama_usaha', 'deskripsi_usaha', 'visi', 'misi']);

        if ($request->hasFile('foto_usaha')) {
            if ($profile->foto_usaha) {
                Storage::disk('public')->delete($profile->foto_usaha);
            }
            $data['foto_usaha'] = $request->file('foto_usaha')->store('profile', 'public');
        }

        $profile->update($data);
        return redirect()->back()->with('success', 'Profil usaha berhasil diperbarui!');
    }

    public function editContact()
    {
        $contact = Contact::firstOrCreate([]);
        return view('admin.settings.contact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $contact = Contact::first();
        $request->validate([
            'whatsapp' => 'required',
            'instagram' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'google_maps' => 'required'
        ]);

        $contact->update($request->all());
        return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
    }
}