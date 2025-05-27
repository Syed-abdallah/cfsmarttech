<?php
namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerAddressController extends Controller
{
  
// public function index(Request $request)
// {
//     $customer = auth('customer')->user();

//     // Fetch addresses that match the logged-in customer's ID
//     $addresses = CustomerAddress::where('customer_id', $customer->id)->get();

//     return response()->json($addresses);
// }


  public function showaddress()
    {
        $customer = Auth::guard('customer')->user();
        $addresses = $customer->addresses()->latest()->get();
        
        return view('customer.dashboard.address.index', compact('addresses'));
    }
public function index()
{
    $customer = Auth::guard('customer')->user();
    $addresses = $customer->addresses()->latest()->get();
    
    return response()->json($addresses);
}
 public function create()
    {
        return view('customer.dashboard.address.create');
    }
public function store(Request $request)
{
    dd('test');
    $customer = auth('customer')->user();
    
    $data = $request->validate([
        'full_name' => 'required',
        'phone' => 'required',
        'address_line1' => 'required',
        'address_line2' => 'nullable',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'country' => 'required',
        'is_default' => 'sometimes|boolean',
    ]);
    
    if (!empty($data['is_default'])) {
        $customer->addresses()->update(['is_default' => false]);
    }
    
    // Add the customer_id to the data before creating
    $data['customer_id'] = $customer->id;
    
    $address = CustomerAddress::create($data);
        session()->flash('toast', [
        'type' => 'success',
        'message' => 'Address created successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
    return redirect()->back();
    // return response()->json($address);
    // dd($request->all());
}


    public function update(Request $request, CustomerAddress $address)
    {
        $customer = auth('customer')->user();

        if ($address->customer_id !== $customer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'full_name' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required',
            'address_line2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'is_default' => 'sometimes|boolean',
        ]);
        

        if (!empty($data['is_default'])) {
            $customer->addresses()->update(['is_default' => false]);
        }

        $address->update($data);

        return response()->json($address);
    }

    public function destroy(CustomerAddress $address)
    {
        $customer = auth('customer')->user();

        if ($address->customer_id !== $customer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $address->delete();
            session()->flash('toast', [
        'type' => 'success',
        'message' => 'Address deleted successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
return redirect()->back();
        // return response()->json(['message' => 'Address deleted successfully.']);
    }

    public function setDefault(CustomerAddress $address)
    {
        $customer = auth('customer')->user();
    
        if ($address->customer_id !== $customer->id) {
            return back()->with('error', 'Unauthorized action.');
        }
    
        $customer->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);
            session()->flash('toast', [
        'type' => 'success',
        'message' => 'Default address updated successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
    
        return back();
    }
    
    
    
    
}
