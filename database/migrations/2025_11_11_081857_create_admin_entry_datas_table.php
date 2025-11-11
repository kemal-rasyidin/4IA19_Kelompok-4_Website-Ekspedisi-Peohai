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
        Schema::create('admin_entry_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_entry_date_id')->constrained()->onDelete('cascade');
            $table->string('customer');
            $table->integer('qty');
            $table->date('tgl_stuffing');
            $table->string('sl_sd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_entry_datas');
    }
};
