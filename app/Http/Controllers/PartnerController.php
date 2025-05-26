<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{

   public function __construct()
    {
        $this->middleware('permission:create partner')->only('create');
        $this->middleware('permission:view partner')->only('index');
        $this->middleware('permission:show partner')->only('show');
        $this->middleware('permission:edit partner')->only('edit');
        $this->middleware('permission:update partner')->only('update');
        $this->middleware('permission:toggle partner')->only('toggleStatus');
  
    }

    private function uploadImage($file)
    {
        $uploadPath = public_path('uploads/partners');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $fileName);
        
        return $fileName; // Return only the filename (not full path)
    }
    public function index()
{
    $partners = Partner::latest()->get(); // or use paginate() if you prefer
    return view('admin.partners.index', compact('partners'));
}

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $this->uploadImage($request->file('image'));

        Partner::create([
            'image' => $imageName, // Store only the filename
            'is_active' => $request->has('is_active')
        ]);
               session()->flash('toast', [
        'type' => 'success',
        'message' => 'Partner added successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);

        return back();
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = ['is_active' => $request->has('is_active')];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($partner->image && file_exists(public_path('uploads/partners/' . $partner->image))) {
                unlink(public_path('uploads/partners/' . $partner->image));
            }
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $partner->update($data);
                    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Partner updated successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
        return back();
    }

    public function destroy(Partner $partner)
    {
        // Delete image file
        if ($partner->image && file_exists(public_path('uploads/partners/' . $partner->image))) {
            unlink(public_path('uploads/partners/' . $partner->image));
        }

        $partner->delete();
                    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Partner deleted successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
        return back();
    }

    public function toggleStatus(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);
                    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Status updated successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
        return back();
    }
}