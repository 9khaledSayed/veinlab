<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('salary_report_id');
            $table->decimal('salary');
            $table->decimal('allowance')->nullable(); // ['housing_allowance' => 500,  transfer_allowance => 600]
            $table->decimal('deductions')->default(0);
            $table->decimal('additions')->default(0);
            $table->decimal('net_salary');
            $table->integer('total_days');
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

            $table->foreign('salary_report_id')
                ->references('id')
                ->on('salary_reports')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('salaries');
    }
}
