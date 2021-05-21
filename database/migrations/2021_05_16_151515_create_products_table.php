<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id')->autoIncrement();
            $table->integer("category_id");
            $table->string("category_multi")->nullable();
            $table->integer('admin_id');
            $table->string('title');
            $table->string('slug');
            $table->string('code')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('price')->nullable();
            $table->integer('price_root')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('url_buy')->nullable();
            $table->integer('sort')->default(0)->nullable();
            $table->integer('view')->default(0)->nullable();
            $table->integer('status')->default(1);
            $table->string('type', 20)->nullable();
            $table->integer('choose_1')->default(0)->nullable()->comment("1: Active 0: Blocked");
            $table->integer('choose_2')->default(0)->nullable()->comment("1: Active 0: Blocked");
            $table->integer('choose_3')->default(0)->nullable()->comment("1: Active 0: Blocked");
            $table->integer('choose_4')->default(0)->nullable()->comment("1: Active 0: Blocked");
            $table->text('title_seo')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_key')->nullable();
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
