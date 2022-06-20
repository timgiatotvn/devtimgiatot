<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->string('address')->nullable();
            $table->string('zalo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('google')->nullable();
            $table->string('telephone')->nullable();
            $table->string('code_header')->nullable();
            $table->string('code_body')->nullable();
            $table->string('code_footer')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('content_footer')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
