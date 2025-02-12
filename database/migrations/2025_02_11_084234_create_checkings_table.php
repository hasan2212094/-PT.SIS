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
        Schema::create('checkings', function (Blueprint $table) {
            $table->id();
            $table->string('no_unit');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('note');
            $table->date('date_finding');
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkings');
    }
};
