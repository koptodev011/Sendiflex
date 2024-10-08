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
        Schema::create('total_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('total_payment');
            $table->integer('remaining_amount');
            $table->unsignedBigInteger('month_id'); // Make sure this column is present
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_payments');
    }
};
