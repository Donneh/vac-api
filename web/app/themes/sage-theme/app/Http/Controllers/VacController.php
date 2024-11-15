<?php
namespace App\Http\Controllers;

use App\models\Question;
use App\Services\VacService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class VacController extends Controller
{

    private VacService $vacService;

    public function __construct(VacService $vacService)
    {
        $this->vacService = $vacService;
    }

    public function show($external_id)
    {
        $question = $this->vacService->findById($external_id);
        $question->content = json_decode($question->content);

        return view('vac.show', compact('question'));
    }

    public function index()
    {
        $questions = $this->vacService->getFrequentlyAskedQuestions();
        return view('vac.index', compact('questions'));
    }

    public function findBySubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $questions = $this->vacService->findBySubject($validated['subject']);

        return view('vac.index', compact('questions'));
    }

    public function findByMinistry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ministry' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $questions = $this->vacService->findByMinistry($validated['subject']);

        return view('vac.index', compact('questions'));
    }
}
