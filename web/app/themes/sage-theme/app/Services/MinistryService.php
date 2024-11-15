<?php

namespace App\Services;

use App\models\Ministry;
use Illuminate\Support\Facades\Http;

class MinistryService
{
    const BASE_URL = 'https://opendata.rijksoverheid.nl/v1/infotypes';
    const API_OUTPUT = "json";


    public function getAll()
    {
        $response = Http::get(self::BASE_URL . "/ministry", [
            'output' => self::API_OUTPUT,
        ]);

        $response = json_decode($response->body());


        $ministries = [];
        foreach ($response as $ministry) {
            $ministries[] = Ministry::firstOrCreate([
                'name' => $ministry->name,
                'title' => $ministry->title,
            ]);
        }

        return $ministries;
    }
}
