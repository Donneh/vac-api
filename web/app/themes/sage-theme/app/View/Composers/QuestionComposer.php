<?php

namespace App\View\Composers;

use App\Services\MinistryService;
use App\Services\SubjectService;
use Roots\Acorn\View\Composer;

class QuestionComposer extends Composer
{
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
            'subjects' => (new SubjectService())->getAll(),
            'ministries' => (new MinistryService())->getAll(),
        ];
    }
}
