<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('vacation_id');
            $table->integer('no_days');
            $table->integer('no_days_carried');
            $table->decimal('balance');
            $table->integer('year');
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');

            $table->foreign('vacation_id')
                ->references('id')
                ->on('vacation_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_balances');
    }
}
