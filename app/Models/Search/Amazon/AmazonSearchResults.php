<?php

namespace App\Models\Search\Amazon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSearchResults extends Model
{
    use HasFactory;
    protected $table="tbl_amazon_search_results";
    protected $fillable=[
        'search_result_id',
        'meta_id',
        'search_result_position',
        'search_result_title',
        'search_result_asin',
        'search_result_link',
        'search_result_image',
        'created_at',
        'updated_at'

    ];


    public function tbl_amazon_search_results_category()
    {
        return $this->hasMany("tbl_amazon_search_results_category","search_result_id");
    }

    public function tbl_amazon_search_results_price()
    {
        return $this->hasMany("tbl_amazon_search_results_price","search_result_id");
    }
    public function tbl_search_meta()
    {
        return $this->belongsTo(AmazonSearchMeta::class);
    }
}
