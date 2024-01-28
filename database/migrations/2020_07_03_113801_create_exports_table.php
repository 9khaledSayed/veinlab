<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->decimal('amount');
            $table->string('CheckNo')->nullable();
            $table->string('bank')->nullable();
            $table->dateTime('checkDate')->nullable();
            $table->string('thisAbout')->nullable();
            $table->string('reason')->nullable();
            $table->integer('type'); // 1 hospital dues - 2 doctor dues - 3 stock dues - 5 salaries
            $table->string('serial_no');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hospital_id')
                ->references('id')
                ->on('hospitals');

            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exports');
    }
}
