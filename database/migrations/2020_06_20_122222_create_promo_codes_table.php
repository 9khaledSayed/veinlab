<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_analysis_id')->nullable()->unique();
            $table->string('code')->unique();
            $table->integer('percentage');
            $table->integer('type');
            $table->integer('include');
            $table->timestamp('from');
            $table->timestamp('to')->useCurrent();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('main_analysis_id')
                  ->references('id')
                  ->on('main_analyses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
