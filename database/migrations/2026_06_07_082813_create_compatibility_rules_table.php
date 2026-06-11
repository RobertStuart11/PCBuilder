<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compatibility_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id_1')
                  ->constrained('components')
                  ->onDelete('cascade');
            $table->foreignId('component_id_2')
                  ->constrained('components')
                  ->onDelete('cascade');
            $table->enum('rule_type', [
                'socket',
                'tdp',
                'form_factor',
                'memory_type',
                'pcie',
                'general'
            ])->default('general');
            $table->boolean('is_compatible')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compatibility_rules');
    }
};