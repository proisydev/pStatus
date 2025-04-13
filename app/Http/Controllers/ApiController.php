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

            $responseAccDetails = $client->get( config('services.api_status.get.api.account_details'));
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

    public function getMonitorDetails(Request $request, $id) {
        $client = new Client();
        $ifIDisSame = true; // Initialize the variable to true by default

        try {
            $publicPageUrl = config('services.api_status.get.api.public_pages');

            $responsePublicPage = $client->get($publicPageUrl);
            $dataPublicPage = json_decode($responsePublicPage->getBody(), true);

            if (isset($dataPublicPage['data']['psps'][0]['monitors']) && in_array($id, $dataPublicPage['data']['psps'][0]['monitors'])) {
                $idPublicPage = str_replace(config('services.api_status.ur_stats'), '', $dataPublicPage['data']['psps'][0]['standard_url']);
                $specificMonitorUrl = config('services.api_status.get.api.specific_monitor');

                $url = str_replace(
                    ['{page_id}', '{monitor_id}'],
                    [$idPublicPage, $id],
                    $specificMonitorUrl
                );

                $responseMonitor = $client->get($url);  
                $dataMonitor = json_decode($responseMonitor->getBody(), true);

                return view('monitor_details', [
                    'id' => $id,
                    'monitor' => $dataMonitor['data']['monitor'],
                    'stats' => $dataMonitor['data']['statistics'],
                    'logs' => $dataMonitor['data']['monitor']['logs'],
                    'dailyRatios' => $dataMonitor['data']['monitor']['dailyRatios'],
                    'days' => $dataMonitor['data']['days'],
                    'responseTimes' => $dataMonitor['data']['monitor']['responseTimes'],
                ]);
            } else {
                $ifIDisSame = false; // Set to false if the ID is not found
                throw new \Exception('Monitor not found');
            }
        } catch (\Exception $e) {
            if ($ifIDisSame === false) {
                abort(404, 'Monitor not found');
            } else {
                return view('errors/api_error', ['error' => $e->getMessage()]);
            }
        }
    }
}
