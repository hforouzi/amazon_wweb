<?php

namespace App\Models\Search\Amazon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSearchMeta extends Model
{
    use HasFactory;
    protected $table="tbl_amazon_search_meta";
    protected $fillable=[
        "meta_create_date",
        "meta_search_term",
        "meta_category_id",
        "product_id"    ];

    public function amazon_search_result()
    {
        return $this->hasMany(AmazonSearchResults::class);
    }
}
