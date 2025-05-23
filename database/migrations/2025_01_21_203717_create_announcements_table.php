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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('post_id');
            $table-> string('title');
            $table->longText('content');
            $table->json('images')->nullable();
            $table->string('channel_id');
            $table->timestamps();
        });

        Schema::create('announcements_readers', function (Blueprint $table) {
            $table->id();
            $table-> string('post_id');
            $table-> string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
