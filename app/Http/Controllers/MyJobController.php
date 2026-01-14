<?php

namespace App\Http\Controllers;

use App\Models\MyJob;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class MyJobController extends Controller
{   

    public function index(){
        return Inertia::render('Jobs', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
    }
    public function create(){
        return Inertia::render('job/CreateJob');
    }

    public function store(Request $request){
        // dd($request);
        $validated = $request->validate([
            'job_title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],

            'company_name' => ['required', 'string', 'max:255'],
            'company_url' => ['required', 'url'],
            'application_url' => ['required', 'url'],

            'company_logo' => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
            'location' => ['required', 'string'],

            'min_currency_value' => ['required', 'integer', 'min:10000', 'max:500000'],
            'max_currency_value' => ['required', 'integer', 'min:10000', 'max:500000', 'gte:min_currency_value'],

            'language_tags' => ['required', 'array', 'max:5'],
            'language_tags.*' => ['string'],
        ]);

        // Handle logo upload
        if($request->hasFile('company_logo')){
            $validated['company_logo'] = $request
                ->file('company_logo')
                ->store('company-logos', 'public');
        }

        MyJob::create($validated);

        return redirect()->route('jobs')->with('success', 'Job created Successfully');
    }
}
