<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function landing()
    {
        return Inertia::render('Client/index');
    }

    public function notAuthorized()
    {
        return Inertia::render('Auth/NotAuthorized');
    }
}
