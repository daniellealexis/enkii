<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            return;
        }

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 28)->unique();
            $table->string('name', 128);
            $table->string('email', 254)->unique();
            $table->string('password');
            $table->string('twitter_handle', 15)->nullable()->default(null);
            $table->string('job_title', 50)->nullable()->default(null);
            $table->rememberToken();
            $table->timestampsTz();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
