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
        Schema::create('rezervations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_archived')->default(false)->index();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'approved', 'declined']);
            $table->string('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('rezervations');
    }
};
