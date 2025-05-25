<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;

class FAQController extends Controller 
{
    public function __construct()
    {
        $this->middleware('permission:create faq')->only('create');
        $this->middleware('permission:view faq')->only('index');
        $this->middleware('permission:edit faq')->only('edit');
        $this->middleware('permission:update faq')->only('update');

  
    }
    public function index()
    {
        $faqs = Faq::all();
    
    
        // $pages = Page::all()->groupBy('district');
    
     
        return view('admin.faq.index', compact('faqs'));
    }


    // Admin: Store a new FAQ
    public function create()
    {
        // Simply return the view to show the form for creating a new FAQ
        return view('admin.faq.create');
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);
    
        // Create a new FAQ entry using the validated data
        Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);
    
        // Redirect back with a success message
        return redirect()->route('cfadmin.faqs.index')->with('success', 'FAQ created successfully.');
    }
    
    public function edit($id)
    {
        // Find the FAQ by ID, or return a 404 error if not found
        $faq = Faq::findOrFail($id);
    
        // Return the edit view with the FAQ data
        return view('admin.faq.edit', compact('faq'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);
    
        // Find the FAQ by ID
        $faq = Faq::findOrFail($id);
    
        // Update the FAQ with the new data
        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);
    
        // Redirect back to the FAQ index page with a success message
        return redirect()->route('cfadmin.faqs.index')->with('success', 'FAQ updated successfully.');
    }
    
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }
}
