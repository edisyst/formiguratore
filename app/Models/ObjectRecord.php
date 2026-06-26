<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjectRecord extends Model
{
    protected $fillable = ['element_id', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function element(): BelongsTo
    {
        return $this->belongsTo(Element::class);
    }
}
