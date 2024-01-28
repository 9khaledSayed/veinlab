<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToWaitingLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('waiting_labs', function (Blueprint $table) {
            $table->string('cultivation')->nullable();
            $table->enum('growth_status', ['no_growth', 'growth'])->nullable();
            $table->longText('high_sensitive_to')->nullable();
            $table->longText('moderate_sensitive_to')->nullable();
            $table->longText('resistant_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waiting_labs', function (Blueprint $table) {
            //
        });
    }
}
