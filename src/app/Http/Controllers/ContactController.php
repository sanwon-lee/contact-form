<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Services\ContactCsvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = Contact::search($request->all())
            ->latest()
            ->paginate(7)
            ->withQueryString();

        $categories = Category::all();

        return view('contacts.index', compact('contacts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $genderOptions = Category::genderOptions();

        $contactData = Session::get('contact_data');

        return view('contacts.create', compact('categories', 'genderOptions', 'contactData'));
    }

    /**
     * Show the form for confirming inputs.
     */
    public function confirm(StoreContactRequest $request)
    {
        $validated = $request->validated();

        $category = Category::find($validated[Contact::COL_CATEGORY_ID]);

        Session::put('contact_data', $validated);

        return view('contacts.confirm', compact('validated', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('contacts.create');
        }

        $contactData = Session::get('contact_data');

        if (!$contactData) {
            return redirect()->route('contacts.create');
        }

        Contact::create($contactData);

        Session::forget('contact_data');

        return redirect()->route('contacts.thanks')->with('contact_submitted', true);
    }

    /**
     * Show the thanks page after successfully storing contact.
     */
    public function thanks()
    {
        if (!Session::has('contact_submitted')) {
            return redirect()->route('contacts.create');
        }

        return view('contacts.thanks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back();
    }

    /**
     * Export the specified resources as a CSV file.
     */
    public function export(Request $request, ContactCsvService $csvService)
    {
        $contacts = Contact::search($request->all())
            ->latest()
            ->paginate(7);

        return $csvService->download($contacts);
    }
}
