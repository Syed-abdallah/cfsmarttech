<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
       public function __construct()
    {
        $this->middleware('permission:create product')->only('create');
        $this->middleware('permission:view product')->only('index');
        $this->middleware('permission:show product')->only('show');
        $this->middleware('permission:edit product')->only('edit');
        $this->middleware('permission:update product')->only('update');
        $this->middleware('permission:view product invoice')->only('invoice');
        $this->middleware('permission:update product status')->only('updateStatus');
  
    }
    public function index()
    {
        // dd('yes');
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
       $request->validate([
    'name' => 'required|string|max:255',
    'price' => 'required|numeric|min:0',
    'quantity' => 'required|integer|min:0',
    'sku' => 'required|string|unique:products,sku',
    'description' => 'nullable|string',
    'text' => 'nullable|string',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

$data = $request->except(['image', 'image1', 'image2']);

$publicPath = public_path('uploads/products');
if (!File::exists($publicPath)) {
    File::makeDirectory($publicPath, 0755, true);
}

// Handle image uploads
foreach (['image', 'image1', 'image2'] as $field) {
    if ($request->hasFile($field)) {
        $file = $request->file($field);

        // Generate unique filename
        $uniqueName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

        // Move to uploads/products folder
        $file->move($publicPath, $uniqueName);

        // Save file name to $data
        $data[$field] = $uniqueName;
    }
}

// Save to database
Product::create($data);
    
 
    
        return redirect()->route('cfadmin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

  public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'sku' => 'required|string|unique:products,sku,'.$product->id,
        'description' => 'nullable|string',
        'text' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except(['image', 'image1', 'image2']);
    $publicPath = public_path('uploads/products');

    // Handle image uploads
    foreach (['image', 'image1', 'image2'] as $field) {
        if ($request->hasFile($field)) {
            // Delete old image if exists
            if ($product->$field) {
                $oldImagePath = public_path('uploads/products/' . $product->$field);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $file = $request->file($field);
            // Generate unique filename
            $uniqueName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
            // Move to uploads/products folder
            $file->move($publicPath, $uniqueName);
            // Save file name to $data
            $data[$field] = $uniqueName;
        }
    }

    $product->update($data);

    return redirect()->route('cfadmin.products.index')->with('success', 'Product updated successfully.');
}
   public function destroy(Product $product)
{
    // Delete associated images
    foreach (['image', 'image1', 'image2'] as $imageField) {
        if ($product->$imageField) {
            $imagePath = public_path('uploads/products/' . $product->$imageField);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
    }

    $product->delete();

    return redirect()->route('cfadmin.products.index')->with('success', 'Product deleted successfully.');
}
}