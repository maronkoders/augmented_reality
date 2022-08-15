<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Topic;
use App\Traits\ModelHandler;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class SubjectsController extends Controller
{
    use ModelHandler;

    public function index()
    {
        $subjects = Subject::with('level')->paginate(20);
        return Inertia::render('Subjects/index',[
            'filters' =>[],
            'subjects' => $subjects
        ]);
    }
    public function getSubjects()
    {
        try {
            return response()->json(['success' => true,'subjects' => Subject::all()]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => $th->getMessage()]);
        }
    }

    public function create()
    {
        $level = Level::all();
        return Inertia::render('Subjects/create')->with(['levels' => $level]);
    }

    public function createSubject()
    {
        Subject::create(Request::validate([
            'name' => ['required', 'max:100'],
            'level_id' =>['required']
        ]));

        return Redirect::route('subjects')->with('success', 'New subject was created.');
    }

    public function topics()
    {
        $topicss = Topic::paginate(10);
        return Inertia::render('Topics/index',[
            'filters' =>[],
            'topics' => $topicss
        ]);
    }
}
