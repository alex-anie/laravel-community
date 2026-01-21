<?php

namespace App\Http\Controllers;

use App\Models\MyJob;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndependentController extends Controller
{
    
    public function home(Request $request){
        $jobs = MyJob::query()
            ->when($request->search, fn($q, $search) =>
                $q->where('job_title', 'like', "%{$search}%")
            )
                ->orderByDesc("id")
                ->paginate(10)
                ->withQueryString();

        return Inertia::render('Home', [
            'jobs' => $jobs->through(fn($job)=>[
                "id" => $job->id,
                "job_title" => $job->job_title,
                "content" => $job->content,
                "company_name" => $job->company_name,
                "company_url" => $job->company_url,
                "application_url" => $job-> application_url,
                "company_logo" => $job->company_logo,
                "location" => $job->location,
                "min_currency_value" => $job->min_currency_value,
                "max_currency_value" => $job->max_currency_value,
                "language_tags" => $job->language_tags,
                "created_at" => $job->created_at,
                "updated_at" => $job->updated_at
            ]),

            'selectedJob' => $request->job
                ? MyJob::select([
                    "id",
                    "job_title",
                    "content",
                    "company_name",
                    "company_url",
                    "application_url",
                    "company_logo",
                    "location",
                    "min_currency_value",
                    "max_currency_value",
                    "language_tags",
                    "created_at",
                    "updated_at",
                ])->find($request->job)
                : null,

            'filters' => $request->only(['search']),
        ]);
    }
    public function about(){
        return Inertia::render('About');
    }
}
