<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('crawler_category_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('price')->default(0);
            $table->integer('price_root')->default(0);
            $table->string('price_crawler')->nullable();
            $table->string('price_root_crawler')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('href')->nullable();
            $table->string('type', 20);
            $table->integer('status')->default(1);
            $table->integer('admin_id')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
