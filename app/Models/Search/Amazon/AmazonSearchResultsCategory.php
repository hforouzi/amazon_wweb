<?php

namespace App\Models\Search\Amazon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSearchResultsCategory extends Model
{

    use HasFactory;
    protected $table="tbl_amazon_search_results_category";
    protected $fillable=[
        "search_result_category_id",
        "search_result_id",
        "search_result_category_name",
        "search_result_category_amazon_id"
        ];
}
