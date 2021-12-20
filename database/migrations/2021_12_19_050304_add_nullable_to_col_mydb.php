<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToColMydb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->float('product_price')->nullable()->change();
            $table->timestamp('Product_price_date')->nullable()->change();
            $table->string('product_detail')->nullable()->change();
        });
        Schema::table('tbl_amazon_search_meta', function (Blueprint $table) {
            $table->string("meta_category_id")->nullable()->change();
            $table->integer("product_id")->nullable()->change();
        });
        Schema::table('tbl_amazon_search_results', function (Blueprint $table) {
          //  $table->char("search_result_position",50)->nullable()->change();
            $table->string("search_result_title")->nullable()->change();
          //  $table->char("search_result_asin",50)->nullable()->change();
            $table->string("search_result_link")->nullable()->change();
            $table->string("search_result_image")->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            //
        });
        Schema::table('tbl_amazon_search_meta', function (Blueprint $table) {
            //
        });
        Schema::table('tbl_amazon_search_results', function (Blueprint $table) {
            //
        });
    }
}
