<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method sync(mixed $taxes)
 */
class BaseModel extends Model
{
    use HasFactory;
}
