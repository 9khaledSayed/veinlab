<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_analyses', function (Blueprint $table) {
            $table->id();
            $table->longText('general_name');
            $table->longText('abbreviated_name');
            $table->string('code')->unique();
            $table->decimal('discount')->default(0);
            $table->integer('demand_no')->default(0);
            $table->decimal('cost')->default(0);
            $table->decimal('price')->default(0);
            $table->decimal('price_insurance')->default(0);
            $table->decimal('price_hospital')->default(0);
            $table->boolean('has_cultivation')->default(false);
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
        Schema::dropIfExists('main_analyses');
    }
}
