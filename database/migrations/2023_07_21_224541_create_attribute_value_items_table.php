<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attribute_value_x_items', function (Blueprint $table) {
            $table->id();
            // attribute_value_id is the id of the attribute value that has this item
            $table->foreignId('attribute_value_id')->constrained()->onDelete('cascade');
            // item_id is the id of the item that has this attribute value
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_x_items');
    }
};
