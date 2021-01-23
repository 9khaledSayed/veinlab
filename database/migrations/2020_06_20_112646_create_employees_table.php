<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('branch_id');
            $table->string('fname_arabic');
            $table->string('mname_arabic')->nullable();
            $table->string('lname_arabic');
            $table->string('fname_english');
            $table->string('mname_english')->nullable();
            $table->string('lname_english');
            $table->date('birthdate');
            $table->unsignedBigInteger('nationality_id');
            $table->integer('marital_status')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('identity_type')->nullable();
            $table->string('id_num');
            $table->date('id_issue_date')->nullable();
            $table->date('id_expire_date')->nullable();
            $table->string('passport_num')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expire_date')->nullable();
            $table->string('issue_place')->nullable();
            $table->integer('emp_num');
            $table->date('joined_date');
            $table->string('workshift')->nullable();
            $table->string('contract_type');
            $table->date('start_date');
            $table->integer('contract_period')->nullable();
            $table->decimal('basic_salary');
            $table->string('allowance', 1000)->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_master')->default(false);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('shift_type'); // 1 for morning && 2 for evening
            $table->foreign('branch_id')
                ->references('id')
                ->on('branches');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
