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
            $table->uuid('id')->primary();
            $table->uuid('entry_period_id');
            $table->foreign('entry_period_id')->references('id')->on('entry_periods')->onDelete('cascade');

            $table->string('qty')->nullable();
            $table->date('tgl_stuffing')->nullable();
            $table->enum('sl_sd', ['SL', 'SD'])->nullable();
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
            $table->bigInteger('harga_trucking')->nullable();
            $table->string('si_final')->nullable();
            $table->date('ba')->nullable();
            $table->date('ba_balik')->nullable();
            $table->string('no_inv')->nullable();
            $table->string('alamat_penerima_barang')->nullable();
            $table->string('nama_penerima')->nullable();
            $table->enum('pph_status', ['PPH', 'Non'])->nullable();

            $table->date('tgl_marketing')->nullable();
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->string('muat_barang')->nullable();
            $table->string('vessel')->nullable();
            $table->bigInteger('door_daerah')->nullable();
            $table->bigInteger('stufing_dalam')->nullable();

            $table->string('freight')->nullable();
            $table->date('tgl_freight')->nullable();

            $table->bigInteger('thc')->nullable();
            $table->bigInteger('asuransi')->nullable();
            $table->bigInteger('bl')->nullable();
            $table->bigInteger('ops')->nullable();
            $table->bigInteger('total_marketing')->nullable();

            $table->bigInteger('asuransi_inv')->nullable();
            $table->bigInteger('adm')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->bigInteger('pph23')->nullable();
            $table->bigInteger('total_inv')->nullable();

            $table->bigInteger('refund')->nullable();
            $table->bigInteger('diterima')->nullable();

            $table->bigInteger('bu_lia')->nullable();
            $table->bigInteger('nol')->nullable();

            $table->decimal('persentase_marketing', 10, 2)->nullable();

            $table->string('agen_daerah')->nullable();
            $table->string('keterangan_marketing')->nullable();

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
