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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status', 50)->default('Pending');
            $table->timestampTz('order_date')->useCurrent();
            $table->unsignedInteger('total_amount');
            $table->jsonb('billing_address')->nullable();
            $table->string('payment_intent')->nullable();
            $table->tinyInteger('silverware')->default(0);
            $table->text('instructions')->nullable();
            $table->tinyInteger('self_pickup')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
