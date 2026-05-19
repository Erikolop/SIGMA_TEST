<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->string('item_name', 100);
            $table->integer('item_qty')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
