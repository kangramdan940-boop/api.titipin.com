<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();
            $table->bigInteger('subtotal');
            $table->bigInteger('fee');
            $table->bigInteger('ongkir')->default(0);
            $table->bigInteger('total');
            $table->enum('status', ['processing', 'buying', 'packing', 'shipping', 'delivered', 'cancelled'])->default('processing');
            $table->string('resi')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
