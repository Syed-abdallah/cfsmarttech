<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'paragraph' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('sliders'), $imageName);

        Slider::create([
            'heading' => $request->heading,
            'paragraph' => $request->paragraph,
            'image' => $imageName,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('cfadmin.sliders.index')->with('success', 'Slider added successfully!');
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'paragraph' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'heading' => $request->heading,
            'paragraph' => $request->paragraph,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            $oldImagePath = public_path('uploads/products/'.$slider->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/products'), $imageName);
            $data['image'] = $imageName;
        }

        $slider->update($data);

        return redirect()->route('cfadmin.sliders.index')->with('success', 'Slider updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        // Delete image file
        $imagePath = public_path('uploads/products/'.$slider->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $slider->delete();

        return redirect()->route('cfadmin.sliders.index')->with('success', 'Slider deleted successfully!');
    }

    public function toggleStatus(Slider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);
        return back()->with('success', 'Status updated successfully!');
    }
}