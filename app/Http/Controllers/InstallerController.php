<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallerController extends Controller
{
    public function __construct()
    {
        
    }
    protected function updateEnv($data = array())
    {
        
            if (count($data) > 0) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);

                // Loop through given data
                foreach ((array) $data as $key => $value) {
                    // Loop through .env-data
                    foreach ($env as $env_key => $env_value) {
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if ($entry[0] == $key) {
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        
    }
    public function index()
    {
        if (env('IS_INSTALLED') == 0) {

        } 
    }
    public function serverRequirements()
    {
    }
    public function step1()
    {
    }
    public function saveStep1()
    {
    }
    public function step2()
    {
    }
    public function saveStep2()
    {
    }
    public function siteSetting()
    {
    }
    public function insertSiteSetting()
    {
    }
    public function createAdmin()
    {
    }
    public function insertAdmin()
    {
    }
}
