<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VacService
{
    const BASE_URL = "https://opendata.rijksoverheid.nl/v1/infotypes";
    const API_OUTPUT = "json";
    const OFFSET = 0;
    const ROWS = 25;

    public function getFrequentlyAskedQuestions(int $page = 0): array
    {
        $response = Http::get(self::BASE_URL . "/faq", [
            'output' => self::API_OUTPUT,
            'rows' => self::ROWS,
            'offset' => self::OFFSET + $page * self::ROWS,
        ]);

        $response = json_decode($response->body());

        $questions = [];
        foreach ($response as $question) {
            $questions[] = $this->questionFromArray($question);
        }

        return $questions;
    }

    public function findByMinistry(string $ministry): array
    {
        $response = Http::get(self::BASE_URL . "/faq/ministries/" . $ministry, [
            'output' => self::API_OUTPUT,
            'rows' => self::ROWS,
            'offset' => self::OFFSET
        ]);

        $response = json_decode($response->body());

        $questions = [];
        foreach ($response as $faq) {
            $questions[] = $this->questionFromArray($faq);
        }

        return $questions;
    }

    public function findBySubject(string $subject): array
    {
        $response = Http::get(self::BASE_URL . "/faq/subjects/" . $subject, [
            'output' => self::API_OUTPUT,
            'rows' => self::ROWS,
            'offset' => self::OFFSET
        ]);

        $response = json_decode($response->body());

        $questions = [];
        foreach ($response as $question) {
            $questions[] = $this->questionFromArray($question);
        }


        return $questions;
    }

    private function questionFromArray($question): array
    {
        return [
            'id' => $question->id,
            'type' => $question->type,
            'canonical' => $question->canonical,
            'dataurl' => $question->dataurl,
            'question' => $question->question,
            'last_modified' => $question->lastmodified,
        ];
    }
}
