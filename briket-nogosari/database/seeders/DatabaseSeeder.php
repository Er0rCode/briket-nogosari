<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Login Admin Utama
        User::create([
            'name' => 'Admin Briket Nogosari',
            'email' => 'admin@nogosari.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat Data Profil Awal UMKM
        Profile::create([
            'nama_usaha' => 'Briket Nogosari',
            'deskripsi_usaha' => 'Produsen briket arang batok kelapa berkualitas tinggi dari Desa Nogosari. Kami berkomitmen menyediakan bahan bakar ramah lingkungan dengan standar kualitas terbaik.',
            'visi' => 'Menjadi produsen briket arang lokal terpercaya yang mampu menembus pasar nasional maupun global dengan mempertahankan kualitas hijau alami.',
            'misi' => 'Mengoptimalkan potensi limbah kelapa desa, menyediakan bahan bakar alternatif yang efisien, serta menjaga stabilitas panas produk demi kepuasan pelanggan.',
        ]);

        // Buat Data Hubungi Kami & Google Maps UMKM
        Contact::create([
            'whatsapp' => '6281234567890', // Sesuaikan nomor WA aktif tanpa tanda +
            'instagram' => 'briket_nogosari',
            'email' => 'info@briketnogosari.com',
            'alamat' => 'Desa Nogosari, Kec. Rowokangkung, Lumajang, Jawa Timur',
            'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.218116521503!2d112.6133481!3d-7.961224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788281a5624ddc%3A0xa1936be753d0434!2sUniversitas%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1710000000000',
        ]);
    }
}