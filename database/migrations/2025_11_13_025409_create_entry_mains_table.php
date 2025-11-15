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
        Schema::create('entry_mains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_period_id')->constrained('entry_periods')->onDelete('cascade');

            $table->string('qty')->nullable();
            $table->date('tgl_stuffing')->nullable();
            $table->string('sl_sd')->nullable();
            $table->string('customer')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->string('jenis_barang')->nullable();
            $table->string('pelayaran')->nullable();
            $table->string('nama_kapal')->nullable();
            $table->string('voy')->nullable();
            $table->string('tujuan')->nullable();
            $table->date('etd')->nullable();
            $table->date('eta')->nullable();
            $table->string('no_cont')->nullable();
            $table->string('seal')->nullable();
            $table->string('agen')->nullable();
            $table->date('dooring')->nullable();
            $table->string('nopol')->nullable();
            $table->string('supir')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('harga', 15, 2)->nullable();
            $table->string('si_final')->nullable();
            $table->date('ba')->nullable();
            $table->date('ba_balik')->nullable();
            $table->string('no_inv')->nullable();
            $table->string('alamat_penerima_barang')->nullable();
            $table->string('nama_penerima')->nullable();

            $table->enum('pph_status', ['pph', 'non'])->nullable();
            // $table->decimal('pph_amount', 15, 2)->nullable();

            // $table->string('status')->default('draft')->after('no_cont');
            // $table->dropColumn('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_mains');
    }
};
