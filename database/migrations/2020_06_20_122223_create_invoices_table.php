
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('promo_code_id')->nullable();
            $table->enum('transfer', [1,2,3,4,5]);
            $table->longText('main_analysis');
            $table->string('packages');
            $table->longText('purchases');
            $table->decimal('total_price');
            $table->decimal('total_cost');
            $table->decimal('tax')->default(0);
            $table->decimal('discount')->default(0);
            $table->decimal('amount_paid')->nullable();
            $table->integer('pay_method')->default(1);
            $table->string('serial_no');
            $table->string('policy_no')->nullable();
            $table->string('barcode');
            $table->string('doctor')->nullable();
            $table->integer('approved')->default(0);
            $table->dateTime('approved_date')->nullable();
            $table->integer('result_created')->default(0);
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onUpdate('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onUpdate('cascade');

            $table->foreign('hospital_id')
                ->references('id')
                ->on('hospitals')
                ->onUpdate('cascade');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade');

            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->onUpdate('cascade');

            $table->foreign('promo_code_id')
                ->references('id')
                ->on('promo_codes')
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
        Schema::dropIfExists('invoices');
    }
}
