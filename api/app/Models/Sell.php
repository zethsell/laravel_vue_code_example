<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'sells';
    protected $fillable = ['id', 'created_at'];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function details(): HasMany
    {
        return $this->hasMany(ProductSell::class, 'sell_id');
    }
}
