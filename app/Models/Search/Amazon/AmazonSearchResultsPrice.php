<?php

namespace App\Models\Search\Amazon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSearchResultsPrice extends Model
{
    use HasFactory;
    protected $table="tbl_amazon_search_results_price";
    protected $fillable=[
        "search_result_price_id",
        "search_result_price_symbol",
        "search_result_price_value",
        "search_result_price_currency",
        "search_result_price_raw",
        "search_result_price_asin",
        "search_result_price_link"

    ];
}
