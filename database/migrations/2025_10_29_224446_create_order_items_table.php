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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 14, 4);
            $table->integer('quantity')->default(1);
            $table->json('description')->nullable();
            $table->unsignedBigInteger('order_id')->index('order_items_order_id_foreign');
            $table->unsignedBigInteger('product_id')->index('order_items_product_id_foreign');
            $table->string('name', 191);
            $table->decimal('tax')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
