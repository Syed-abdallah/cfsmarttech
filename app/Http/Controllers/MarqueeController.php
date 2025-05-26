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
           session()->flash('toast', [
        'type' => 'success',
        'message' => 'Announcement added successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
        return redirect()->route('cfadmin.marquees.index')
           ;
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
       session()->flash('toast', [
        'type' => 'success',
        'message' => 'Announcement updated successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
    return redirect()->route('cfadmin.marquees.index')
       ;
}
    public function destroy(Marquee $marquee)
    {
        $marquee->delete();
       session()->flash('toast', [
        'type' => 'success',
        'message' => 'Announcement deleted successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
        return redirect()->route('cfadmin.marquees.index')
           ;
    }

    public function toggleStatus(Marquee $marquee)
    {
        $marquee->update(['is_active' => !$marquee->is_active]);
               session()->flash('toast', [
        'type' => 'success',
        'message' => 'Announcement status updated successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);

        return back();
    }

}
