<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->index();
            $table->integer('category_id')->index();
            $table->integer('user_id')->default(1);
            $table->integer('origin_price')->default(0);
            $table->integer('price')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('amount_sold')->default(0);
            $table->tinyInteger('discount_percent')->default(0);
            $table->tinyInteger('status')->default(1)->index();
            $table->tinyInteger('hot')->default(0);
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
        Schema::dropIfExists('products');
    }
}
