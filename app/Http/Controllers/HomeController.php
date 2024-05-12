<?php

namespace App\Http\Controllers;

use App\Policy;
use App\Agent;
use App\Claim;
use App\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index()
     {
         if (auth()->user()->role === 'Admin') {
             $notClosedClaims = Claim::where('status', '!=', 'closed')->count();
             $numberOfCustomers = Customer::count();
             $numberOfAgents = Agent::count();
             $companyEarnings = Policy::sum('companyBrokerage');
             $numberOfActivePolicies = Policy::whereDate('end_date', '>', now())->count();
 
             return view('home', compact('notClosedClaims', 'numberOfCustomers', 'numberOfAgents', 'companyEarnings', 'numberOfActivePolicies'));
         } elseif (auth()->user()->role === 'Agent') {
             $userId = auth()->user()->id;
             $yourCustomers = Customer::where('agent_id', $userId)->count();
             $policiesUnderAgent = Policy::where('refered_by', $userId)->pluck('p_number');
             $yourOpenClaims = Claim::whereIn('p_number', $policiesUnderAgent)->where('status', '!=', 'closed')->count();
             $yourActivePolicies = Policy::where('refered_by', $userId)
            ->where('end_date', '>', now())
            ->count();
             return view('home', compact('yourCustomers', 'yourOpenClaims', 'yourActivePolicies'));
         } elseif (auth()->user()->role === 'Customer') {
            $userId = auth()->user()->id;
            $yourActivePolicies = Policy::where('customer_id', $userId)
                ->where('end_date', '>', now())
                ->count();
            $yourOpenClaims = Claim::where('customer_id', $userId)
                ->where('status', '!=', 'closed')
                ->count();
                

            return view('home', compact('yourActivePolicies', 'yourOpenClaims'));
        }
     }
}
