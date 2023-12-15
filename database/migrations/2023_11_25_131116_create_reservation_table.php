<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_archived')->default(false)->index();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->string('session_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['created','pending', 'approved', 'declined']);

            // code
            $table->string('code')->nullable();

            // pick_up_location_id
            $table->unsignedBigInteger('pick_up_location_id')->nullable();

            // email, user_name, user_address, user_phone, user_ip
            $table->string('email')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_surname')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('id_number')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_ip')->nullable();


            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('zip_code')->nullable();


            $table->enum('invoice_type', ['individual', 'company'])->nullable();
            $table->enum('invoice_company_type', ['individual', 'company'])->nullable();
            $table->string('invoice_company_name')->nullable();
            $table->string('invoice_company_address')->nullable();
            $table->string('invoice_company_vat_number')->nullable();
            $table->string('tax_administration')->nullable();


            $table->string('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['created','pending', 'paid', 'failed'])->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_currency')->nullable();
            $table->string('payment_description')->nullable();
            $table->string('payment_error')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
