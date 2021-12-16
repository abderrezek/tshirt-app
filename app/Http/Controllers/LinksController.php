<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinksController extends Controller
{
    public function boutique()
    {
        return view('boutique');
    }

    public function clothe($slug)
    {
        $clothe = Clothe::where('slug', '=', $slug)->firstOrFail();

        $prevSlug = Clothe::where('id', '<', $clothe->id)->orderBy('id', 'desc')->first();

        $nextSlug = Clothe::where('id', '>', $clothe->id)->orderBy('id')->first();

        return view('clothe', [
            'clothe' => $clothe,
            'prevSlug' => $prevSlug,
            'nextSlug' => $nextSlug,
        ]);
    }

    public function aPropos()
    {
        return view('a-propos');
    }

    public function ouAcheter()
    {
        return view('ou-acheter');
    }

    public function faq()
    {
        return view('faq');
    }

    public function contact()
    {
        return view('contact');
    }

    public function panier()
    {
        return view('panier');
    }

    public function profil()
    {
        return view('profil');
    }

    public function address()
    {
        return view('address');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
