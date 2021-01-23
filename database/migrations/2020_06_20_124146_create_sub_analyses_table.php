<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_analysis_id');
            $table->longText('name');
            $table->string('unit')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('main_analysis_id')
                ->references('id')->on('main_analyses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_analyses');
    }
}
