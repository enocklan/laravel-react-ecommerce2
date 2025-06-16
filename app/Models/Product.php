<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    Public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    Public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
