<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_analysis_id');
            $table->unsignedBigInteger('waiting_lab_id');
            $table->longText('lab_notes');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('waiting_lab_id')
                  ->references('id')
                  ->on('waiting_labs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
