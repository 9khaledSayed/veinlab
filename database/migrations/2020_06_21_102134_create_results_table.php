<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waiting_lab_id');
            $table->unsignedBigInteger('sub_analysis_id');
            $table->unsignedBigInteger('main_analysis_id');
            $table->unsignedBigInteger('patient_id');
            $table->unique(['waiting_lab_id', 'sub_analysis_id']);
            $table->string('result');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_id')
                  ->references('id')
                  ->on('patients');

            $table->foreign('sub_analysis_id')
                  ->references('id')
                  ->on('sub_analyses');

            $table->foreign('waiting_lab_id')
                  ->references('id')
                  ->on('waiting_labs');
            $table->foreign('main_analysis_id')
                  ->references('id')
                  ->on('main_analyses');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
