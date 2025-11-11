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
            $table->string('qty');
            $table->date('tgl_stuffing');
            $table->string('sl_sd');
            $table->string('customer');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('jenis_barang');
            $table->string('pelayaran');
            $table->string('nama_kapal');
            $table->string('voy');
            $table->string('tujuan');
            $table->date('etd');
            $table->date('eta');
            $table->string('no_count');
            $table->string('seal');
            $table->string('agen');
            $table->date('dooring');
            $table->string('nopol');
            $table->string('supir');
            $table->string('no_telp');
            $table->string('harga');
            $table->string('si_final');
            $table->date('ba');
            $table->date('ba_balik');
            $table->string('no_inv');
            $table->string('alamat_penerima_barang');
            $table->string('nama_penerima');
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
