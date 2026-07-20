<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
class PageController extends Controller
{

    public function home()
    {
        return view('home');
    }



    public function about()
    {
        return view('pages.about');
    }



   



    public function contact()
    {
        return view('pages.contact');
    }



  



    public function faq()
    {
        return view('pages.faq');
    }
    public function bookTrip()
{

    $locations = Route::select('origin')
        ->union(
            Route::select('destination')
        )
        ->distinct()
        ->pluck('origin');


     return view('pages.book-trip', [
        'locations' => $locations,
        'hideFooter' => true
    ]);

}

}