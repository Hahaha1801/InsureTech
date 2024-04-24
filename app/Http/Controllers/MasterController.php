<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class MasterController extends Controller
{
    public function group()
    {
        return view('masters.group');
    }

    public function store(Request $request)
    {
        $groupName = $request->input('group_name');

        // Retrieve existing groups from config file
        $groups = Config::get('dropdownOptions.groups', []);

        // Check if the group name already exists
        if (in_array($groupName, $groups)) {
            // Handle duplicate group name error here
            return redirect()->back()->withErrors(['group_name' => 'The group name already exists.'])->withInput();
        }
        $configPath = config_path('dropdownOptions.php');
        // Retrieve existing options from config file
$options = include(config_path('dropdownOptions.php'));

// Add the new group to the 'groups' array
$options['groups'][] = $groupName;

// Update the config file with the new options
File::put($configPath, '<?php return ' . var_export($options, true) . ';');


        // Clear the cached config to reflect changes
        Artisan::call('config:clear');

        return redirect()->route('policies.index');
    }

}
