<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Show home page view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            return view('contact-us');
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }
}
