<?php

namespace App\Services;

use App\models\Question;
use Illuminate\Http\Client\Response;
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

        return $this->fetchQuestions($response);
    }

    public function findByMinistry(string $ministry): array
    {
        $response = Http::get(self::BASE_URL . "/faq/ministries/" . $ministry, [
            'output' => self::API_OUTPUT,
            'rows' => self::ROWS,
            'offset' => self::OFFSET
        ]);

        return $this->fetchQuestions($response);
    }

    public function findBySubject($subject): array
    {
        $response = Http::get(self::BASE_URL . "/faq/subjects/" . $subject, [
            'output' => self::API_OUTPUT,
            'rows' => self::ROWS,
            'offset' => self::OFFSET
        ]);

        return $this->fetchQuestions($response);
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

    public function findById($external_id)
    {
        $question = Question::where('external_id', $external_id)->first();
        if (!$question) {
            $response = Http::get(self::BASE_URL . "/faq/" . $external_id, [
                'output' => self::API_OUTPUT,
            ]);

            if ($response->successful()) {
                $response = json_decode($response->body());

                $question = new Question();
                $question->question = $response->question;
                $question->canonical = $response->canonical;
                $question->content = json_encode($response->content);
                $question->external_id = $response->id;
                $question->save();
            }
        }

        return $question;
    }

    public function fetchQuestions(Response $response): array
    {
        $response = json_decode($response->body());

        $questions = [];
        foreach ($response as $question) {
            $questions[] = $this->questionFromArray($question);
        }

        return $questions;
    }
}
