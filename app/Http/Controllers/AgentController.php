<?php

namespace App\Http\Controllers;


use App\User;
use App\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all(); 
        return view('agent.viewAll', ['agents' => $agents]);
    }
    public function show(Agent $agent)
    {
        return view('agent.show', ['agent' => $agent]);
    }
    public function destroy(Agent $agent)
    {      
        $user = User::where('id', $agent->agent_id)->first();

        if (!$user) {
            return redirect()->route('agent.viewAll')->with('error', 'User not found');
        }
        
        $agent->delete();
        $user->delete();
        
        return redirect()->route('agent.viewAll')->with('success', 'Agent deleted successfully');
    }
}
