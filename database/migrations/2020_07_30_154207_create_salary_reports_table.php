<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('issue_date');
            $table->integer('status')->default(1);
            $table->integer('has_changes')->default(0);
            $table->integer('employees_no');
            $table->decimal('total_deductions');
            $table->decimal('total_additions');
            $table->decimal('total_net_salary')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_reports');
    }
}
