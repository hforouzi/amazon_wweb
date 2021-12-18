<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAmazonSearchMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_amazon_search_meta', function (Blueprint $table) {
            $table->id("search_meta_id");
            $table->timestamp("meta_create_date");
            $table->string("meta_search_term");
            $table->string("meta_category_id");
            $table->integer("product_id");
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
        Schema::dropIfExists('tbl_amazon_search_meta');
    }
}
