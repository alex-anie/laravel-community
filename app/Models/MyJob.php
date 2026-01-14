<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyJob extends Model
{
    protected $fillable = [
        'job_title',
        'content',
        'company_name',
        'company_url',
        'application_url',
        'company_logo',
        'location',
        'min_currency_value',
        'max_currency_value',
        'language_tags',
    ];
    
    protected $casts = [
        'language_tags' => 'array',
        'min_currency_value' => 'integer',
        'max_currency_value' => 'integer',
    ];
}
