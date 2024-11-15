<?php

namespace App\Http\Controllers;

use App\Services\MinistryService;
use Illuminate\Routing\Controller;

class MinistryController extends Controller
{

    private MinistryService $service;

    public function __construct(MinistryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $ministries = $this->service->getAll();

        return view('ministry.index', compact('ministries'));
    }
}
