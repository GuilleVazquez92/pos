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
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('cart_user_id_foreign');
            $table->unsignedBigInteger('product_id')->index('cart_product_id_foreign');
            $table->string('name', 191);
            $table->unsignedInteger('quantity');
            $table->decimal('price');
            $table->decimal('tax')->default(0);
            $table->json('added')->nullable();
            $table->json('removed')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
