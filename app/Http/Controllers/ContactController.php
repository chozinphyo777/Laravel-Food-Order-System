<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::when(request('search'),function($query){
            $query->where('email','like','%'.request('search').'%')
            ->orWhere('name','like','%'.request('search').'%')
            ->orWhere('subject','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(2);
        return view('dashboard.contacts.index',compact('contacts'));
    }
    public function create()
    {
       return view('frontend.contact.contact-form');
    }

    public function delete($id)
    {
       $contact = Contact::findOrFail($id);
       $contact->delete();
       return redirect()->route('contactList')->with('message','Successfully Deleted!');
    }

    
    public function store(Request $req)
    {
        $validated = Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required',
            'subject' => 'nullable',
            'message' => 'nullable',
        ])->validate();
        Contact::create($validated);
        return back()->with('message','Successfully Sent!');
        
    }
}

    
