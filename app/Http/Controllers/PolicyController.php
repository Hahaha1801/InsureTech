<?php
namespace App\Http\Controllers;

use App\Claim;
use App\Policy;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->role === 'Admin') {
            $policies = Policy::all();
        } elseif (Auth::user()->role === 'Agent') {
            $agentId = Auth::user()->id;
            $customers = Customer::where('agent_id', Auth::id())->get();
            $customerIds = $customers->pluck('id')->toArray();
            $policies = Policy::whereIn('customer_id', $customerIds)->get();
        } elseif (Auth::user()->role === 'Customer') {
            $customerId = Auth::user()->id;
            $policies = Policy::where('customer_id', $customerId)->get();
        } else {
            abort(403, 'Unauthorized access');
        }

        return view('policies.index', compact('policies'));
    }

    public function create()
    {
        if (Auth::user()->role === 'Admin') {
            $customers = Customer::all();
        } elseif (Auth::user()->role === 'Agent') {
            $customers = Customer::where('agent_id', auth()->user()->id)->get();
        } else {
            abort(403, 'Unauthorized access');
        }
        return view('policies.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $referedBy = null;

        if ($user->role === 'Admin') {
            $referedBy = "1";
        } elseif ($user->role === 'Agent') {
            $referedBy = $user->id;
        }

        $data = $request->except('_token');
        $data['refered_by'] = $referedBy;
        
        // Fetch policy brokerage rates from config
        $policyBrokerageRates = Config::get('dropdownOptions.policy');
        $data['companyBrokerage'] = 0.00;

        // Loop through the policy brokerage rates
        foreach ($policyBrokerageRates as $policyRate) {
            // Split policy name and brokerage rate
            list($policyName, $brokerageRate) = explode(', ', $policyRate);

            // Check if the policy name matches the one in the request
            if ($data['p_name'] == $policyName) {
                $brokerageAmount = $data['total'] * (float)$brokerageRate / 100;

                $data['companyBrokerage'] = $brokerageAmount;
                
                // Break the loop as we found the matching policy
                break;
            }
        }
        
        Policy::create($data);
        return redirect()->route('policies.index');
    }


    public function show($p_number)
    {
        $policy = Policy::where('p_number', $p_number)->firstOrFail();
        $hasClaim = Claim::where('p_number', $p_number)->exists();
        $claimStatus = Claim::where('p_number', $p_number)->value('status');
        return view('policies.show', compact('policy', 'hasClaim', 'claimStatus'));
    }
    public function edit($id)
    {
        $policy = Policy::findOrFail($id);
        return view('policies.edit', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);
        $policy->update($request->all());
        return redirect()->route('policies.index');
    }

    public function destroy($id)
    {
        $policy = Policy::where('p_number', $id)->firstOrFail();
        $policy->delete();
        return redirect()->route('policies.index');
    }

    public function uploadPdf(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);

        // Validate the uploaded PDF file
        $request->validate([
            'pdf_file' => 'required|mimes:pdf',
        ]);

        $pdfPath = $request->file('pdf_file')->storeAs('public/pdfs', $policy->p_number . '.pdf');

        return redirect()->back()->with('success', 'Policy PDF uploaded successfully.');
    }

    
}
