<?php


namespace App\Http\Controllers;

use App\Models\RoomPrice;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = RoomPrice::all();
        return view('admin.roomType.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.roomType.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'size' => 'required|integer',
    //         'price' => 'required|numeric',
    //     ]);

    //     RoomPrice::create($validated);

    //     return redirect()->route('cfadmin.RoomPrice.index')->with('success', 'Price added successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(RoomPrice $RoomPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomPrice $RoomPrice)
    {
        return view('admin.roomType.edit', compact('RoomPrice'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id) // Accept the ID as parameter
{
    // Find the specific record by ID
    $RoomPrice = RoomPrice::findOrFail($id);

    // Validate only the price field
    $validated = $request->validate([
        'price' => 'required|numeric',
    ]);

    // Update ONLY the price
    $RoomPrice->update([
        'price' => $validated['price']
    ]);
  session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Price update successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
    return redirect()->route('cfadmin.roomtype.index');
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(RoomPrice $RoomPrice)
    // {
    //     $RoomPrice->delete();
    //     return redirect()->route('cfadmin.RoomPrice.index')->with('success', 'Price deleted successfully');
    // }
}