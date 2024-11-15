<?php

namespace App\Services;

use App\models\Subject;
use Illuminate\Support\Facades\Http;

class SubjectService
{
    const BASE_URL = 'https://opendata.rijksoverheid.nl/v1/infotypes';
    const API_OUTPUT = "json";


    public function getAll()
    {
        $response = Http::get(self::BASE_URL . "/subject", [
            'output' => self::API_OUTPUT,
        ]);

        $response = json_decode($response->body());


        $subjects = [];
        foreach ($response as $subject) {
            $subjects[] = Subject::firstOrCreate([
                'name' => $subject->name,
                'title' => $subject->title,
            ]);
        }

        return $subjects;
    }
}
