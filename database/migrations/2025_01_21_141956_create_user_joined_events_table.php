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
        Schema::create('user_joined_events', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('event_id');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('tbl_user_info')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_joined_events');
    }
};
