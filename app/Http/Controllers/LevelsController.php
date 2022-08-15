<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class LevelsController extends Controller
{
    public function index()
    {
        $levels = Level::paginate(20);
        return Inertia::render('Levels/index',['filters' =>[],'levels' => $levels]);
    }

    public function newLevel(Request $request)
    {
       Level::create(Request::validate(['name' => ['required', 'max:100']]));
       return Redirect::to('levels')->with('success', 'New level was created.');
    }

    public function getLevels()
    {
        try {
            if(Request::get('source') === "homepage")
            {
                return response()->json(['success' => true,'levels' =>   Level::all()]);
            }
            return response()->json(['success' => true,'levels' =>  Level::paginate(10)['data']]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $level = Level::find($id);

        $subjets = Subject::where('level_id', $level->id)->get();
        foreach ($subjets as $sub) {
            $topics =  Topic::where('subject_id', $sub->id)->get();
            foreach ($topics as $topic) {
               $topic->delete();
            }
            $sub->delete();
        }

        $level->delete();
        return Redirect::to('levels')->with('success', 'Record was  deleted.');
    }

    public function update($id)
    {
        $level = Level::find($id);
        $level->update(
            Request::validate([
                'name' => ['required', 'max:100']
            ])
        );

        return Redirect::back()->with('success', 'level updated.');
    }


    public function create()
    {
        return Inertia::render('Levels/create');
    }

    public function getLevel($id)
    {

        $level = Level::find($id);

        return Inertia::render('Levels/edit', [
            'organization' => [
                'id' => $level->id,
                'name' => $level->name,
            ],
        ]);
    }
}
