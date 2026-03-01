<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
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
        $genders = Gender::options();

        return view('contacts.index', [
            'contacts' => $contacts,
            'categories' => $categories,
            'genders' => $genders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('content', 'id');
        $genders = Gender::options();

        return view('contacts.create', [
            'categories' => $categories,
            'genders' => $genders,
        ]);
    }

    /**
     * Show the form for confirming user inputs before storing the resource.
     */
    public function confirm(StoreContactRequest $request)
    {
        $validated = $request->validated();

        Session::put('contact_data', $validated);

        $displayData = collect($validated)->except(['tel_1', 'tel_2', 'tel_3'])->all();
        $category = Category::find($validated['category_id'])->content;
        $genders = Gender::options();

        return view('contacts.confirm', [
            'displayData' => $displayData,
            'category' => $category,
            'genders' => $genders,
        ]);
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

        $finalData = collect($contactData)->except(['tel_1', 'tel_2', 'tel_3'])->all();

        Contact::create($finalData);

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
        $contacts = Contact::search($request->all())->latest()->get();

        return $csvService->download($contacts);
    }
}
