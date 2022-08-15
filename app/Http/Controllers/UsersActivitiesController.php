<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Http;

class UsersActivitiesController extends Controller
{

    public function __construct()
    {
       $this->baseUrl = config('app.env') == "local" ? "http://localhost:8000/" :"http://demo.storensharesystems.com/";
    }

    public function index(HttpRequest $request)
    {
       $page = $request->page??"1";
       $response =  Http::get($this->baseUrl.'api/v1/getLogs?page='.$page);




       if($response->status() == 200)
       {
            $resp =  $response->json();
            if($resp['status'] == "success")
            {
                $usersData = $resp['logs'];
            }else{
                $usersData = [];
            }
    }
        // $usersData = $this->database->table('user_logs')
        //                     ->join('users','user_logs.user_id' ,'=','users.id')
        //                     ->select('users.username','users.email','users.first_name','users.last_name','users.id as userId','user_logs.*')
        //                     ->orderBy('user_logs.created_at','desc')
        //                     ->groupBy('user_logs.user_id')
        //                     ->paginate(10);
        return Inertia::render('Organizations/Index',[
            'filters' => Request::all('search', 'trashed'),
            'users' => $usersData
        ]);

    }

    public function create()
    {
        return Inertia::render('Organizations/Create');
    }

    public function store()
    {
        Auth::user()->account->organizations()->create(
                Request::validate([
                    'name' => ['required', 'max:100'],
                    'email' => ['nullable', 'max:50', 'email'],
                    'phone' => ['nullable', 'max:50'],
                    'address' => ['nullable', 'max:150'],
                    'city' => ['nullable', 'max:50'],
                    'region' => ['nullable', 'max:50'],
                    'country' => ['nullable', 'max:2'],
                    'postal_code' => ['nullable', 'max:25'],
                ]));

        return Redirect::route('organizations')->with('success', 'Organization created.');
    }

    public function viewMore(HttpRequest $request, $id)
    {
        $page = $request->page ??"1";
        $response =  Http::get($this->baseUrl.'api/v1/userLogs?id='.$id.'&page='.$page);
        if($response->status() == 200)
        {
             $resp =  $response->json();

            //  dd($resp);
             if($resp['status'] == "success")
             {
                 $user = $resp['user'];
                 $logs =  $resp['logs'];
             }else{
                 $user = [];
                 $logs = [];
             }
        }else{

        }

        return Inertia::render('Organizations/Edit', [
                'logs' =>$logs,
                'user' =>$user
            ]);
    }

    public function viewDateLogs(HttpRequest $request, $id,$date)
    {
        $response =  Http::get($this->baseUrl.'api/v1/dateLogs?id='.$id.'&date='.$date);
        if($response->status() == 200)
        {
             $resp =  $response->json();
             if($resp['status'] == "success")
             {
                 $user = $resp['user'];
                 $logs =  $resp['logs'];
              }else{
                 $user = [];
                 $logs = [];

             }
        }else{

        }

        return Inertia::render('Organizations/DateLogs', [
                'logs' =>$logs,
                'user' =>$user,
                'date' => $date
            ]);
    }

    public function update(Organization $organization)
    {
        $organization->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'Organization updated.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }
}
