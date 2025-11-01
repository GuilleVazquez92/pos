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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pay_type')->nullable();
            $table->integer('order_type')->nullable();
            $table->integer('call_number')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable()->index('orders_customer_id_foreign');
            $table->decimal('total_price');
            $table->decimal('discount_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
