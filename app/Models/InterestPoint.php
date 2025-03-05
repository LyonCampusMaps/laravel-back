<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterestPoint extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attributes' => 'json',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
