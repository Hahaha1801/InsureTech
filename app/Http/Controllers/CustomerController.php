<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function index()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->id === 1 && Auth::user()->role === 'Admin') {
            // If user is admin, fetch all customers
            $customers = Customer::all();
        } else {
            // If user is not admin, fetch customers associated with the agent_id
            $customers = Customer::where('agent_id', Auth::id())->get();
        }

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
