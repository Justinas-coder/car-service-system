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

            $table->integer('year')
                ->nullable();

            $table->bigInteger('total_price')
                ->nullable();

            $table->string('status')
                ->nullable();

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
