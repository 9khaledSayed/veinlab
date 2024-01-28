<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitingLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting_labs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('main_analysis_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->integer('result')->default(1);
            $table->integer('status')->default(1);
            $table->string('report')->nullable();

            $table->string('cultivation')->nullable();
            $table->enum('growth_status', ['no_growth', 'growth'])->nullable();
            $table->longText('high_sensitive_to')->nullable();
            $table->longText('moderate_sensitive_to')->nullable();
            $table->longText('resistant_to')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('patient_id')
                ->references('id')
                ->on('patients');

            $table->foreign('main_analysis_id')
                ->references('id')
                ->on('main_analyses');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onUpdate('cascade');

            $table->foreign('hospital_id')
                ->references('id')
                ->on('hospitals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waiting_labs');
    }
}
