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
// Create tbl_user_info table
Schema::create('tbl_user_info', function (Blueprint $table) {
    $table->string('user_id', 20)->primary();
    $table->string('fname', 50);
    $table->string('mname', 50)->nullable();
    $table->string('lname', 50);
    $table->integer('age')->nullable();
    $table->string('gender', 15)->nullable();
    $table->string('house_no', 20)->nullable();
    $table->string('street', 50)->nullable();
    $table->string('brgy', 50)->nullable();
    $table->string('city', 50)->nullable();
    $table->string('province', 50)->nullable();
    $table->string('postal_code', 10)->nullable();
    $table->string('mobile_no', 50)->nullable();
    $table->string('profile_picture')->nullable(); // Change to string for file path
    $table->float('profile_points', 8)->default(0);
    $table->integer('email_verified')->default(0);
    $table->string('account_status')->default('Pending')->nullable();

    $table->string('verified_status')->default('pending'); // Use string for status

    $table->timestamps();
    $table->softDeletes(); // Add soft deletes
});





// Create tbl_login table
Schema::create('tbl_login', function (Blueprint $table) {
    $table->string('user_id', 20)->primary();
    $table->string('email', 255)->unique();
    $table->string('password', 255);
    $table->string('role', 50);


    $table->timestamps();
    $table->softDeletes(); // Add soft deletes
});

// Create tbl_valid_id table
Schema::create('tbl_valid_id', function (Blueprint $table) {
    $table->string('user_id');
    $table->string('id_type', 50);
    $table->string('attachment'); // Change to string for file path
    $table->string('status', 50)->default('pending');


    $table->timestamps();
    $table->softDeletes(); // Add soft deletes
});

Schema::create('password_reset_tokens', function (Blueprint $table) {

    $table->string('email')->primary();
    $table->string('token');
    $table->timestamp('created_at')->useCurrent();



});


Schema::create('registration_tokens', function (Blueprint $table) {
    $table->string('email')->primary();
    $table->string('token');
    $table->timestamp('created_at')->useCurrent();

});



Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_valid_id');
        Schema::dropIfExists('user_tbl');
        Schema::dropIfExists('tbl_login');
    }
};
