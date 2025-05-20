<?php

namespace App\Http\Controllers;

use App\Models\Marquee;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{

   public function __construct()
    {
        $this->middleware('permission:create marquee')->only('create');
        $this->middleware('permission:view marquee')->only('index');
        $this->middleware('permission:show marquee')->only('show');
        $this->middleware('permission:edit marquee')->only('edit');
        $this->middleware('permission:update marquee')->only('update');
        $this->middleware('permission:view marquee invoice')->only('invoice');
        $this->middleware('permission:update marquee status')->only('updateStatus');
  
    }
    
    public function index()
    {
        
        $marquees = Marquee::get();
//   dd($marquees);
        return view('admin.marquee.index', compact('marquees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
         'is_active' => 'required',
        ]);
        
        // dd($request->all()); 
        Marquee::create([
            'content' => $request->content,
            'is_active' => $request->boolean('is_active'), // Returns true/false properly
        ]);
    
        return redirect()->route('cfadmin.marquees.index')
            ->with('success', 'Marquee announcement added successfully.');
    }
    


    public function update(Request $request, Marquee $marquee)
{
    $request->validate([
        'content' => 'required|string|max:500',
        'is_active' => 'sometimes'
    ]);

    $marquee->update([
        'content' => $request->content,
        'is_active' => $request->has('is_active') // This will return true if checkbox was checked
    ]);

    return redirect()->route('cfadmin.marquees.index')
        ->with('success', 'Marquee announcement updated successfully.');
}
    public function destroy(Marquee $marquee)
    {
        $marquee->delete();

        return redirect()->route('cfadmin.marquees.index')
            ->with('success', 'Marquee announcement deleted successfully.');
    }

    public function toggleStatus(Marquee $marquee)
    {
        $marquee->update(['is_active' => !$marquee->is_active]);

        return back()->with('success', 'Marquee status updated successfully.');
    }

}
