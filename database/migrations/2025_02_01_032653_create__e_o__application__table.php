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
        Schema::create('tbl_eo_application', function (Blueprint $table) {
            $table->string('user_id', 20)->primary();
            $table->string('attachment'); 
            $table->string('status', 50)->default('Pending');
            $table->integer('rejection_count')->default(0); 
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_eo_application');
    }
};
