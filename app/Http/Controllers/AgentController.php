<?php

namespace App\Http\Controllers;

use App\User;
use App\Agent;
use App\Policy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $agents = Agent::all();

        foreach ($agents as $agent) {
            $agent->currentMonthBrokerage = $this->calculateCurrentMonthBrokerage($agent->id);
        }

        return view('agent.viewAll', compact('agents'));
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


    private function calculateCurrentMonthBrokerage($agentId)
    {
        $firstDayOfMonth = Carbon::now()->startOfMonth();

        $policies = Policy::where('refered_by', $agentId)
            ->whereDate('created_at', '>=', $firstDayOfMonth)
            ->get();

        $currentMonthBrokerage = $policies->sum('companyBrokerage');

        $brokerageRate = Agent::where('id', $agentId)->value('brokerage_rate');

        $agentCommission = $currentMonthBrokerage * ($brokerageRate / 100);

        return $agentCommission;
    }
}
