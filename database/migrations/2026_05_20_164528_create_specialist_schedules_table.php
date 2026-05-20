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
        Schema::create('specialist_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained()->cascadeOnDelete();
            $table->integer('day_of_week'); // 0 = Sunday, 1 = Monday, etc.
            $table->time('start_time')->default('09:00:00');
            $table->time('end_time')->default('22:00:00');
            $table->boolean('is_working')->default(true);
            $table->timestamps();
            
            $table->unique(['specialist_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialist_schedules');
    }
};
