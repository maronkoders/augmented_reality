<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class TopicController extends Controller
{
    public function index()
    {
        $subjects = Topic::with('subject')->paginate(20);

        return Inertia::render('Topics/index',[
            'filters' =>[],
            'topics' => $subjects
        ]);
    }

    public function create()
    {
        $level = Level::all();
        $subjects = Subject::all();
        return Inertia::render('Topics/create')->with([
            'levels' =>$level,
            'subjects' => $subjects
        ]);
    }

    public function newTopic()
    {
        Topic::create(Request::validate(['name' => ['required', 'max:100'],'subject_id'=>['required'] ,'level_id' =>'required']));
        return Redirect::route('topics')->with('success', 'New subject topic was created.');
    }
}
