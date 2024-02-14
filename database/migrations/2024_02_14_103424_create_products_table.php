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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('level_1')->nullable();
            $table->string('level_2')->nullable();
            $table->string('level_3')->nullable();
            $table->string('price')->nullable();
            $table->string('price_jp')->nullable();
            $table->string('count')->nullable();
            $table->string('properties')->nullable();
            $table->string('joint_purchases')->nullable();
            $table->string('unit_measurement')->nullable();
            $table->string('img')->nullable()->nullable();
            $table->string('display_main')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
