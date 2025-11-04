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
            $table->unsignedBigInteger('customer_id');
            $table->decimal('subtotal', 10, 2);
            // ship
            $table->decimal('shipping_fee', 10, 2)->default(0);
            // bankDiscount
            $table->decimal('bank_discount', 10, 2)->default(0);
            // otherDiscount
            $table->decimal('other_discount', 10, 2)->default(0);
            // total
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
            // shipping info
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            // note
            $table->text('note')->nullable();
            // payment_method
            $table->string('payment_method')->nullable();
            // coupon code
            $table->string('code')->nullable();
            // coupon id
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
