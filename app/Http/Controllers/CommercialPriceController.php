<?php


namespace App\Http\Controllers;

use App\Models\CommercialPrice;
use Illuminate\Http\Request;

class CommercialPriceController extends Controller
{

        public function __construct()
    {
       
        $this->middleware('permission:view commercial')->only('index');
        $this->middleware('permission:edit commercial')->only('edit');
        $this->middleware('permission:update commercial')->only('update');

  
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = CommercialPrice::all();
        return view('admin.commercial.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.commercial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'size' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        CommercialPrice::create($validated);

        return redirect()->route('cfadmin.commercial.index')->with('success', 'Price added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommercialPrice $commercialPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommercialPrice $commercialPrice)
    {
        return view('admin.commercial.edit', compact('commercialPrice'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id) // Accept the ID as parameter
{
    // Find the specific record by ID
    $commercialPrice = CommercialPrice::findOrFail($id);

    // Validate only the price field
    $validated = $request->validate([
        'price' => 'required|numeric',
    ]);

    // Update ONLY the price
    $commercialPrice->update([
        'price' => $validated['price']
    ]);
  session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Price update successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
    return redirect()->route('cfadmin.commercial.index');
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(CommercialPrice $commercialPrice)
    // {
    //     $commercialPrice->delete();
    //     return redirect()->route('cfadmin.commercial.index')->with('success', 'Price deleted successfully');
    // }
}