<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Show contact page view.
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

    /**
     * Create email to send to admin.
     *
     * @param ContactUsRequest $request
     * @return Renderable
     */
    public function create(ContactUsRequest $request)
    {

    }
}
