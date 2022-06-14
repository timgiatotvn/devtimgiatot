<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('crawler_website_id');
            $table->foreign('crawler_website_id')->references('id')->on('crawler_websites');
            $table->string('url');
            $table->string('class_parent')->nullable();
            $table->string('class_url_image')->nullable();
            $table->string('class_url_a')->nullable();
            $table->string('url_page_example')->nullable();
            $table->integer('page_max')->default(1)->nullable();
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
        Schema::dropIfExists('crawler_categories');
    }
}
