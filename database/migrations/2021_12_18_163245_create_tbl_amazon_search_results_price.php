<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAmazonSearchResultsPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_amazon_search_results_price', function (Blueprint $table) {
            $table->id("search_result_price_id");
            $table->char("search_result_price_symbol");
            $table->float("search_result_price_value");
            $table->char("search_result_price_currency");
            $table->string("search_result_price_raw");
            $table->string("search_result_price_asin");
            $table->string("search_result_price_link");
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
        Schema::dropIfExists('tbl_amazon_search_results_price');
    }
}
