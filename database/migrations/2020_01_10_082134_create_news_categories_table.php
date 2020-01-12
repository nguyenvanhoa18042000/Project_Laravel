<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->index();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->integer('total_posts')->default(0);
            $table->string('description')->nullable();
            $table->integer('user_id')->default(1);
            $table->tinyInteger('depth')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_categories');
    }
}
