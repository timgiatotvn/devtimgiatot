<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToCrawlerCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crawler_categories', function (Blueprint $table) {
            $table->string('class_root_list')->nullable()->after("url");
            $table->string('class_detail_name')->nullable()->after("class_url_a");
            $table->string('class_detail_price')->nullable()->after("class_detail_name");
            $table->string('class_detail_price_root')->nullable()->after("class_detail_price");
            $table->string('class_detail_content')->nullable()->after("class_detail_price_root");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crawler_categories', function (Blueprint $table) {
            //
        });
    }
}
