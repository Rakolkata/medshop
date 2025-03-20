<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVeriant extends Model
{
    use HasFactory;
    protected $table = 'product_veriant';
    protected $primaryKey = 'id';
    public $timestamps = false;
    /**
     * Get the product that ows the ProductVeriant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo(Product::class, 'pid', 'id');
    }

}
