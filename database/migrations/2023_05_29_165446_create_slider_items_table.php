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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slider_id',false,true)->nullable();
            $table->string('title');
            $table->string('sub_title')->nullable();

            $table->string('file_desktop')->nullable()->default(null);
            $table->string('file_mobile')->nullable()->default(null);


            $table->string('link')->default(null)->nullable();
            $table->string('link_text')->default(null)->nullable();
            $table->integer('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_items');
    }
};
