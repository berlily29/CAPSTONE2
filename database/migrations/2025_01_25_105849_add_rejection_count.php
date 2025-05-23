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
        Schema::table('tbl_user_info', function (Blueprint $table) {
            $table->integer('rejection_count')->default(0)->before('created_at');; 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_user_info', function (Blueprint $table) {
            $table->dropColumn('rejection_count'); 
        });
    }
};
