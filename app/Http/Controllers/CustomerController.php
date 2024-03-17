<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Fetch all customers from the database
        return view('customer.viewAll', ['customers' => $customers]);
    }
    public function show(Customer $customer)
    {
        return view('customer.show', ['customer' => $customer]);
    }
    public function destroy(Customer $customer)
    {      
        $user = User::where('id', $customer->customer_id)->first();

        if (!$user) {
            return redirect()->route('customer.viewAll')->with('error', 'User not found');
        }
        
        $customer->delete();
        $user->delete();
        
        return redirect()->route('customer.viewAll')->with('success', 'Customer deleted successfully');
    }
    
}
