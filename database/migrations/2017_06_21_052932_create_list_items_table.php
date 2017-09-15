<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('list_items')) {
            Schema::create('list_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('list_id');
                $table->timestampsTz();
                $table->text('title')->default('');
                $table->text('resource_url')->nullable();
                $table->mediumText('description')->default('');
                $table->text('image_url')->nullable();
                $table->unsignedTinyInteger('index');

                $table->foreign('list_id')->references('id')->on('lists');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_items');
    }
}
