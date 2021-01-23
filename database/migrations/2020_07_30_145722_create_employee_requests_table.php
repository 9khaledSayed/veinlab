<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->id();

            $table->integer('type');
            $table->integer('status')->default(2);
            $table->integer('response')->default(0); // 0 => pending , 1 => agreed , 2 => disagreed
            $table->string('comment')->nullable();

            $table->unsignedBigInteger('employee_id');

            /* طلب تعريف بالراتب */                                   // type => 1
            $table->string('directed_to_ar')->nullable();
            $table->string('directed_to_eng')->nullable();
            $table->string('reason')->nullable();
            /* طلب تعريف بالراتب */

            /* طلب اجازه */                                          // type => 2
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->unsignedBigInteger('vacation_id')->nullable();
            /* طلب اجازه */

            /* طلب استئذان */                                       // type => 3
            $table->date('date')->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->string('description')->nullable();
            /* طلب استئذان */

            /* طلب رحله عمل */                                      // type => 4
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            // description
            // from_date
            // to_date
            /* طلب رحله عمل */

            /* طلب سلفه */                                          // type => 5

            // from_date
            $table->integer('amount')->nullable();
            $table->integer('no_months')->nullable();
            // description

            /* طلب سلفه */

            /* طلب شكوي */                                          // type => 6
            //
            $table->string('directed_department')->nullable();
            $table->string('subject')->nullable();
            // description
            /* طلب شكوي */

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
        Schema::dropIfExists('requests');
    }
}
