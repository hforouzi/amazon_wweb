<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAmazonSearchResultsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_amazon_search_results_category', function (Blueprint $table) {
            $table->id("search_result_category_id");
            $table->foreignId("search_result_id")->references("search_result_id")->on("tbl_amazon_search_results");
            $table->string("search_result_category_name");
            $table->string("search_result_category_amazon_id");
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
        Schema::dropIfExists('tbl_amazon_search_results_category');
    }
}
