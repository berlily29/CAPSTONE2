<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_user_info', function (Blueprint $table) {
            $table->string('profile_picture')->default('profile-picture.jpg')->change();
        });
    }

    public function down()
    {
        Schema::table('tbl_user_info', function (Blueprint $table) {
            // If you want to remove the default value, you can do it here
            $table->string('profile_picture')->default(null)->change();
        });
    }
};
