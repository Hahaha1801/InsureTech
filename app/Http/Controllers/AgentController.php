<?php

namespace App\Http\Controllers;

use App\User;
use App\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all(); 
        return view('agent.viewAll', ['agents' => $agents]);
    }
    public function show(Agent $agent)
    {
        $customers = DB::table('customers')->where('agent_id', $agent->id)->get();
        return view('agent.show', ['agent' => $agent, 'customers' => $customers]);
    }
    public function destroy(Agent $agent)
    {      
        $user = User::where('id', $agent->id)->first();

        if (!$user) {
            return redirect()->route('agent.viewAll')->with('error', 'User not found');
        }
        
        $agent->delete();
        $user->delete();

        return redirect()->route('agent.viewAll')->with('success', 'Agent deleted successfully');
    }
}
