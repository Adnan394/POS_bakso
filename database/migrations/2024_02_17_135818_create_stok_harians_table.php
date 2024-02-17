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
        Schema::create('stok_harians', function (Blueprint $table) {
            $table->id();
            $table->integer('bakso_polos');
            $table->integer('bakso_urat');
            $table->integer('bakso_daging');
            $table->foreignId('location_id')->constrained('locations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_harians');
    }
};