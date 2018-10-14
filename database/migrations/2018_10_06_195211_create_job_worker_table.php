<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_worker', function (Blueprint $table) {
            $table->primary(['job_id', 'worker_id']);
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('worker_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('worker_id')->references('id')->on('workers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_worker');
    }
}
