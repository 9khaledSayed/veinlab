<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->decimal('amount');
            $table->string('CheckNo')->nullable();
            $table->string('bank')->nullable();
            $table->dateTime('checkDate')->nullable();
            $table->string('thisAbout')->nullable();
            $table->integer('type');
            $table->string('serial_no');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

            $table->foreign('hospital_id')
                ->references('id')
                ->on('companies');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenues');
    }
}
