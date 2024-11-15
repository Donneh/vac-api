<?php

namespace App\View\Composers;

use App\Services\VacService;
use Roots\Acorn\View\Composer;

class VacComposer extends Composer
{

    private $vacService;

    public function __construct()
    {
        $this->vacService = new VacService();
    }
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'vac.index'
    ];

    public function with()
    {
        return [
            'page' => $_GET['page'] ?? 0,
            'subject' => $_GET['subject'] ?? null,
            'ministry' => $_GET['ministry'] ?? null,
            'questions' => $this->getQuestions()
        ];
    }

    private function getQuestions()
    {
        if (isset($_GET['subject'])) {
            return $this->vacService->findBySubject($_GET['subject']);
        } else if (isset($_GET['ministry'])) {
            return $this->vacService->findByMinistry($_GET['ministry']);
        }

        return $this->vacService->getFrequentlyAskedQuestions($_GET['page'] ?? 0);
    }
}
