<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('percentage');
            $table->integer('wallet')->default(0);
            $table->integer('lifetime_wallet')->default(0);
            $table->integer('no_patients')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('doctors');
    }

}
