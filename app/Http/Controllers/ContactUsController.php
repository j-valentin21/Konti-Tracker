<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

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
     * @return RedirectResponse
     */
    public function create(ContactUsRequest $request): RedirectResponse
    {
        try {
            if ($request->botcheck) {
                return redirect()->back()->withSuccess('Your form has been submitted');
            }
            $data = $request->validated();
            Mail::to('jvalentin0221@gmail.com')->send(new ContactUsMail($data));
            return redirect('/')->with('successMsg', 'Your message has been sent');

        } catch(\Exception $e ) {
            return redirect()->back()->with('errorMsg', 'An issue occurred trying to sent your message. Please try again at a later time.');
        }
    }
}
