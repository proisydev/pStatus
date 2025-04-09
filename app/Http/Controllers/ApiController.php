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
            $domain = Env::get("API_STATUS_URL");

            $responseMonitors = $client->get($domain . "/api/monitors");
            $dataMonitors = json_decode($responseMonitors->getBody(), true);

            $responseHealth = $client->get( $domain . "/health");
            $dataHealth = json_decode($responseHealth->getBody(), true);

            return view('global_status', ['monitors' => $dataMonitors, 'health' => $dataHealth]);
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
