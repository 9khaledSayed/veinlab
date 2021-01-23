<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('status')->default(1);
            $table->integer('type');  // end_service => 0 , suspend_salary => 1 , transfer_employee => 2
            $table->string('notes')->nullable();
            /* انهاء خدمه */
//            $table->string('reason');
            $table->date('termination_date')->nullable();
            $table->decimal('end_of_service')->nullable();
            $table->decimal('entitlements')->nullable();
            $table->decimal('obligations')->nullable();
            $table->string('termination_reason')->nullable();
            $table->string('termination_notes')->nullable();
            /* انهاء خدمه */

            /* ايقاف راتب */
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            // notes
            /* ايقاف راتب */

            /* نقل موظف */
            $table->string('from_position')->nullable();
            $table->string('to_position')->nullable();
            // notes
            /* نقل موظف */

            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

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
        Schema::dropIfExists('decisions');
    }
}
