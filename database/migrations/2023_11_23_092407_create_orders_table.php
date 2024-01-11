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

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('vehicle_make_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('vehicle_model_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->year('year');
            $table->foreignId('service_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('total_price');
            $table->string('status');
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
