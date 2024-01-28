<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowanceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowance_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value')->nullable();
            $table->decimal('value_perc')->nullable();
            $table->integer('type');
            $table->timestamps();
        });
        Schema::create('allowance_type_employee', function (Blueprint $table) {
            $table->primary(['allowance_type_id', 'employee_id']);
            $table->unsignedBigInteger('allowance_type_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('allowance_type_id')
                ->references('id')
                ->on('allowance_types')
                ->onDelete('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
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
        Schema::dropIfExists('allowance_types');
    }
}
