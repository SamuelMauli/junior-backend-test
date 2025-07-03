<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contacts/Index', [
            'contacts' => Contact::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Contacts/Create');
    }

    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
        Contact::create($data);

        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
        ]);
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
        $contact->update($data);

        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        // Bônus: Envio de email
        // Mail::to($contact->email)->send(mailable: new \App\Mail\ContactDeleted());

        $contact->delete();
        return redirect()->route('contacts.index');
    }
}