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
        Schema::create('logistic_rates', function (Blueprint $table) {
            $table->id();
            $table->string('origin_port');
            $table->string('destination_port');
            $table->enum('container_type', ['20ft', '40ft']);
            $table->decimal('base_rate', 10, 2);
            $table->decimal('fuel_surcharge', 10, 2)->default(0);
            $table->decimal('handling_fee', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistic_rates');
    }
};
