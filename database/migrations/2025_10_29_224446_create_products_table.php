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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('barcode', 191)->unique();
            $table->decimal('regular_price')->nullable();
            $table->decimal('price', 14);
            $table->integer('quantity')->default(1);
            $table->decimal('tax')->default(0);
            $table->boolean('is_custom_product')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
