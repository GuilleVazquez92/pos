<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemAddonsTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_item_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->string('name'); // nombre del ingrediente o extra
            $table->decimal('price', 10, 2)->default(0); // precio extra, 0 si es quitar ingrediente
            $table->enum('type', ['extra', 'remove'])->default('extra'); // tipo: agregar o quitar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_addons');
    }
}
