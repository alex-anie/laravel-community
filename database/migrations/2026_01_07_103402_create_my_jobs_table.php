<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('my_jobs', function (Blueprint $table) {
            $table->id();

            $table->string('job_title');
            $table->longText('content');

            $table->string('company_name');
            $table->string('company_url');
            $table->string('application_url');

            $table->string('company_logo')->nullable();
            $table->string('location');

            $table->unsignedBigInteger('min_currency_value');
            $table->unsignedInteger('max_currency_value');

            $table->json('language_tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_jobs');
    }
};
