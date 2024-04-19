<?php

namespace App\Http\Controllers;

use App\Claim;
use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'Admin') {
            $claims = Claim::with('policy')->get();
            return view('claims.index', compact('claims'));
        } elseif (Auth::user()->role === 'Agent') {
            $agentId = Auth::user()->id;
            $policies = Policy::where('refered_by', $agentId)->get();
            
            $pNumbers = $policies->pluck('p_number')->toArray();
            $claims = Claim::whereIn('p_number', $pNumbers)->get();
            
            return view('claims.index', compact('claims'));
        } else {
                    abort(403, 'Unauthorized access');
        }
        
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'p_number' => 'string', 
            'description' => 'nullable|string',
        ]);

        $claim = new Claim();
        $claim->p_number = $request->input('p_number');
        $claim->description = $request->input('description');
        
        $claim->save();

        return redirect()->back()->with('success', 'Claim requested successfully!');
    }

    public function updateStatus(Request $request)
    {
        $p_number = $request->input('p_number');
        $newStatus = $request->input('status');
    
        $claim = Claim::where('p_number', $p_number)->first();
    
        if ($claim) {
            $claim->status = $newStatus;
            $claim->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Claim not found']);
        }
    }
    

}
