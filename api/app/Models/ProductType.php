<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'description'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot'];

    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class, 'product_type_taxes', 'product_type_id', 'tax_id');
    }
}
