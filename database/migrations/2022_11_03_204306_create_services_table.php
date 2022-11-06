<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('category_id');
            $table->text('logo');
            $table->text('thumbnail');
            $table->text('banner');
            $table->string('address');
            $table->string('service');
            $table->double('price', 20, 0);
            $table->string('hotline');
            $table->string('zalo');
            $table->string('rate');
            $table->text('description');
            $table->longText('content');
            $table->integer('status');
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
        Schema::dropIfExists('services');
    }
}
