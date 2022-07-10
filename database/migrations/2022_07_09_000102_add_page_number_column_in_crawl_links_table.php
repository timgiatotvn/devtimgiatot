<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageNumberColumnInCrawlLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crawl_links', function (Blueprint $table) {
            $table->integer('page_number')->after('website_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crawl_links', function (Blueprint $table) {
            $table->dropColumn('page_number');
        });
    }
}
