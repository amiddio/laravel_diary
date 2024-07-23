<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\ContactSendEmailJob;
use App\Mail\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.index');
    }

    public function send(ContactFormRequest $request)
    {
        $validated = $request->validated();

        // Send email via queue
        ContactSendEmailJob::dispatch(data: $validated);

        request()->session()->flash('status', 'success');
        request()->session()->flash('message', 'Your message was successfully sent!');

        return redirect()->route('contact.index');
    }
}
