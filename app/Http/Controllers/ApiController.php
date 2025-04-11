<?php

// This code is helped by https://medium.com/the-code-box-minute/how-to-consume-the-api-in-laravel-a-step-by-step-guide-with-code-example-da780dbc5859 and mine own knowledge. (And i'm new in Laravel lol)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Env;

class ApiController extends Controller
{
    public function getGlobalStatus(Request $request) {
        $client = new Client();

        try {

            $responseMonitors = $client->get(config('services.api_status.get.api.monitors'));
            $dataMonitors = json_decode($responseMonitors->getBody(), true);

            $responseAccDetails = $client->get( config('services.api_status.get.api.account-details'));
            if ($responseAccDetails->getStatusCode() !== 200) {
                throw new \Exception('Failed to fetch account details');
            }
            $dataAccDetails = json_decode($responseAccDetails->getBody(), true);

            return view('global_status', ['monitors' => $dataMonitors, 'account_details' => $dataAccDetails]);
        } catch (\Exception $e) {
            return view('errors/api_error', ['error' => $e->getMessage()]);
        }
    }

    /*public function getIncidents(Request $request) {
        $client = new Client();

        try {
            $responseIncidents = $client->get(config('services.api_status.get.api.incidents'));
            if ($responseIncidents->getStatusCode() !== 200) {
                throw new \Exception('Failed to fetch incidents');
            }
            $dataIncidents = json_decode($responseIncidents->getBody(), true);

            return view('incidents', ['incidents' => $dataIncidents]);
        } catch (\Exception $e) {
            return view('errors/api_error', ['error' => $e->getMessage()]);
        }
    }*/
}
