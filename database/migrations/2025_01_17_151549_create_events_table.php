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
        Schema::create('events', function (Blueprint $table) {
            $table->string('event_id', 255)->primary();
            $table->string('title', 255)-> nullable();
            $table->longText('description')-> nullable();
            $table->json('event_category')-> nullable();
            $table->string('event_organizer')->nullable();
            $table->date('date')->nullable();
            $table->string('venue', 500)->nullable();
            $table->string('target_location', 255)->nullable();
            $table-> string('status')-> default('upcoming');
            $table-> integer('approved')-> default(0);
            $table->string('channel_id')->nullable();
            $table->string('termination_id')-> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
