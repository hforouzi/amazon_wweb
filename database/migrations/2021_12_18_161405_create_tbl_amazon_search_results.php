<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAmazonSearchResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_amazon_search_results', function (Blueprint $table) {
            $table->id("search_result_id");
            $table->foreignId("meta_id")->references("search_meta_id")->on("tbl_amazon_search_meta");
            $table->char("search_result_position");
            $table->string("search_result_title");
            $table->char("search_result_asin");
            $table->string("search_result_link");
            $table->string("search_result_image");
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
        Schema::dropIfExists('tbl_amazon_search_results');
    }
}
