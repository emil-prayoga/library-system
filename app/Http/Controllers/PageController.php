<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show home page
     */
    public function home(): View
    {
        return view('pages.home');
    }

    /**
     * Show about page
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Show contact page
     */
    public function contact(): View
    {
        return view('pages.contact');
    }
}
