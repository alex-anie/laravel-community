<?php

namespace App\Http\Controllers;

use App\Models\MyJob;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class MyJobController extends Controller
{   

    public function index(Request $request){
        $jobs = MyJob::query()
            ->where($request->search, function($query, $search){
                $query->where('job_title', 'like', "%{$search}%");
            })
                ->orderBy("id", "desc")
                ->paginate(20)
                ->withQueryString()
                ->through(fn($job)=>[
                    "id" => $job->id,
                    "job_title" => $job->job_title,
                    "company_name" => $job->company_logo,
                    "company_url" => $job->company_url,
                    "company_logo" => $job->company_logo,
                    "location" => $job->location,
                    "min_currency_value" => $job->min_currency_value,
                    "max_currency_value" => $job->max_currency_value,
                    "language_tags" => $job->language_tags,
                    "created_at" => $job->created_at,
                    "updated_at" => $job->updated_at
                ]);

            return Inertia::render('Jobs', [
                'jobs' => $jobs,
                'filters' => $request->only(['search']),
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
