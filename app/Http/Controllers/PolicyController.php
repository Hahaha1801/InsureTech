<?php
namespace App\Http\Controllers;

use App\Policy;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Admin') {
            $policies = Policy::all();
        } elseif (Auth::user()->role === 'Agent') {
            $agentId = Auth::user()->id;
            $policies = Policy::where('refered_by', $agentId)->get();
        } else {
            abort(403, 'Unauthorized access');
        }

        return view('policies.index', compact('policies'));
    }


public function create()
{
    $customers = Customer::where('agent_id', auth()->user()->id)->get();
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
        Policy::create($data);
        return redirect()->route('policies.index');
    }    
    
    public function show($p_number)
    {
        $policy = Policy::where('p_number', $p_number)->firstOrFail();
        return view('policies.show', compact('policy'));
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
    
}
