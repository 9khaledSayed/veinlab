<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalMainAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_main_analysis', function (Blueprint $table) {
            $table->primary(['hospital_id', 'main_analysis_id']);
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('main_analysis_id');
            $table->decimal('price');

            $table->foreign('hospital_id')
                ->references('id')
                ->on('hospitals')
                ->onDelete('cascade');

            $table->foreign('main_analysis_id')
                ->references('id')
                ->on('main_analyses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_main_analyses');
    }
}
