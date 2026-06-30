<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gallery;
use App\Models\Profile;
use App\Models\Contact;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'profile' => Profile::first(),
            'contact' => Contact::first(),
            'products' => Product::latest()->take(6)->get(),
            'galleries' => Gallery::latest()->take(8)->get()
        ]);
    }
}