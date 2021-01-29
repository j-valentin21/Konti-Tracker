<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show home page view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            return view('index');
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }
}
