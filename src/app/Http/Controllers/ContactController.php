<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);

        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');

        $contact['tel'] = [
            'tel1' => $tel1,
            'tel2' => $tel2,
            'tel3' => $tel3,
        ];

        $categories = Category::all();
        $request->session()->put('categories', $categories);

        $request->session()->put('contact', $contact);

        return view('confirm', compact('contact'));
    }

    public function edit(Request $request)
    {
        $categories = $request->session()->get('categories');

        $contact = $request->session()->get('contact');

        if (!$contact || !$categories) {
        return redirect()->route('index');
        }

        return view('index', compact('categories','contact'));
    }


    public function store(ContactRequest $request)
    {
        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');

        $tel = $tel1 . $tel2 . $tel3;

        $contactData = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contactData['tel'] = $tel;

        Contact::create($contactData);

        return view('thanks');
    }
}
