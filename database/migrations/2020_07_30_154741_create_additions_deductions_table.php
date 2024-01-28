<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionsDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additions_deductions_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');

            $table->integer('type');  // additions => 2 , deductions => 1 , loans => 3
            $table->integer('status')->default(1);
            $table->string('reason');
            $table->decimal('amount');
            $table->date('date')->nullable();
            $table->date('effective_date');
            $table->date('end_date')->nullable();
            $table->date('operational_date')->nullable();
            $table->date('absence_date')->nullable();
            $table->integer('payroll_status')->default(0);
            $table->integer('minutes')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('num_of_months')->nullable();
            $table->string('notes', 10000)->nullable();

            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('Cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additions');
    }
}
