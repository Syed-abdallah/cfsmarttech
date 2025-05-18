<?php


namespace App\Http\Controllers;

use App\Models\AdditionalCost;
use Illuminate\Http\Request;

class AdditionalCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = AdditionalCost::all();
        return view('admin.additionalcost.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.additionalcost.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'size' => 'required|integer',
    //         'price' => 'required|numeric',
    //     ]);

    //     AdditionalCost::create($validated);

    //     return redirect()->route('cfadmin.additionalcost.index')->with('success', 'Price added successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(AdditionalCost $AdditionalCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalCost $AdditionalCost)
    {
        return view('admin.additionalcost.edit', compact('AdditionalCost'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id) // Accept the ID as parameter
{
    // Find the specific record by ID
    $AdditionalCost = AdditionalCost::findOrFail($id);

    // Validate only the price field
    $validated = $request->validate([
        'price' => 'required|numeric',
    ]);

    // Update ONLY the price
    $AdditionalCost->update([
        'price' => $validated['price']
    ]);

    return redirect()->route('cfadmin.additional-cost.index')->with('success', 'Price updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(AdditionalCost $AdditionalCost)
    // {
    //     $AdditionalCost->delete();
    //     return redirect()->route('cfadmin.additionalcost.index')->with('success', 'Price deleted successfully');
    // }
}