<?php

namespace App\Http\Controllers;

use App\Services\SubjectService;
use Illuminate\Routing\Controller;

class SubjectController extends Controller
{
    private SubjectService $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index()
    {
        $subjects = $this->subjectService->getAll();

        return view('subject.index', compact('subjects'));
    }
}
