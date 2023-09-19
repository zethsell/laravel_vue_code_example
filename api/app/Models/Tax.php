<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'taxes';
    protected $fillable = ['id', 'value', 'description'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot'];
}
