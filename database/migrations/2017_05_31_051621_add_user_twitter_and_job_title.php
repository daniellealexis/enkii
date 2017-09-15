<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTwitterAndJobTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'twitter_handle')) {
                $table->string('twitter_handle', 15)
                    ->nullable()
                    ->default(null);
            }

            if (!Schema::hasColumn('users', 'job_title')) {
                $table->string('job_title', 50)
                    ->nullable()
                    ->default(null);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumns('users', ['twitter_handle', 'job_title'])) {
                $table->dropColumn(['twitter_handle', 'job_title']);
            }
        });
    }
}
