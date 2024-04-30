<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->id === 1 && Auth::user()->role === 'Admin') {
            $customers = Customer::all();
        } else {
            $customers = Customer::where('agent_id', Auth::id())->get();
        }

        return view('customer.viewAll', ['customers' => $customers]);
    }

    public function show(Customer $customer)
    {
        $customerId = $customer->id;
        $policies = DB::table('policies')->where('customer_id', $customerId)->get();
        return view('customer.show', ['customer' => $customer, 'policies' => $policies]);
    }

    public function destroy(Customer $customer)
    {      
        $user = User::where('id', $customer->id)->first();

        if (!$user) {
            return redirect()->route('customer.viewAll')->with('error', 'User not found');
        }
        
        $customer->delete();
        $user->delete();
        
        return redirect()->route('customer.viewAll')->with('success', 'Customer deleted successfully');
    }
}
