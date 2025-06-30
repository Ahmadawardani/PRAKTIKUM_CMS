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
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id();
        $table->string('nim')->unique();
        $table->string('nama');
        $table->string('jabatan');
        $table->foreignId('divisi_id')->nullable()->constrained()->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
