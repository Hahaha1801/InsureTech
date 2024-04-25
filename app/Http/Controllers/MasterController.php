<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class MasterController extends Controller
{
    public function index($option)
    {
        if (!array_key_exists($option, config('dropdownOptions'))) {
            abort(404);
        }

        return view('masters.' . $option, compact('option'));
    }


    public function store(Request $request, $option)
    {
        if (!array_key_exists($option, config('dropdownOptions'))) {
            abort(404);
        }

        $masterName = $request->input('master_name');
        $masters = Config::get('dropdownOptions.' . $option, []);

        if (in_array($masterName, $masters)) {
            return redirect()->back()->withErrors(['master_name' => 'The master name already exists.'])->withInput();
        }

        $configPath = config_path('dropdownOptions.php');
        $options = include($configPath);
        $options[$option][] = $masterName;
        File::put($configPath, '<?php return ' . var_export($options, true) . ';');
        Artisan::call('config:clear');

        return redirect()->route('policies.index');
    }
}
