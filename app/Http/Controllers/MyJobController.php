<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MyJobController extends Controller
{
    function create(){
        return Inertia::render('job/CreateJob');
    }
}
