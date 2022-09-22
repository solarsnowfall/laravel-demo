<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function create()
    {
        $contact = new Contact();
        $companies = $this->userCompanies();

        return view('contacts.create', compact('companies', 'contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('message', 'Contact deleted.');
    }

    public function edit(Contact $contact)
    {
        $companies = $this->userCompanies();

        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $companies = $this->userCompanies();

        $contacts = auth()->user()->contacts()->latestFirst()->paginate(10);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'address'       => 'required',
            'company_id'    => 'required|exists:companies,id'
        ]);

        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact successfully created.');
    }

    public function update(Contact $contact, Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'address'       => 'required',
            'company_id'    => 'required|exists:companies,id'
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact successfully updated.');
    }

    protected function userCompanies()
    {
        return auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }
}
