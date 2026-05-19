<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user', 100);
            $table->string('nama_item', 100);
            $table->string('jenis_mutasi', 20);
            $table->integer('sebelum_qty');
            $table->integer('perubahan_qty');
            $table->timestamp('tgl_transaksi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
