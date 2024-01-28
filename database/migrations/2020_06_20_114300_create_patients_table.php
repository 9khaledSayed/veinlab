<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_in_english')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('id_no')->unique();
            $table->string('password');
            $table->unsignedBigInteger('nationality_id');
            $table->integer('gender');
            $table->integer('age');
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('diseases')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->integer('visit_no')->default(1);
            $table->string('device_token')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('patients');
    }
}
