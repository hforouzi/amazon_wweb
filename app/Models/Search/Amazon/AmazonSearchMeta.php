<?php

namespace App\Models\Search\Amazon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSearchMeta extends Model
{
    use HasFactory;
    protected $table="tbl_amazon_search_meta";

    public function amazon_search_result()
    {
        return $this->hasMany(AmazonSearchResults::class);
    }
}
