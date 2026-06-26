<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends Model
{
    protected $fillable = [
        'group_id', 'name', 'type', 'label', 'placeholder',
        'required', 'order', 'configuration',
    ];

    protected $casts = [
        'required' => 'boolean',
        'configuration' => 'array',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function objectRecords(): HasMany
    {
        return $this->hasMany(ObjectRecord::class);
    }
}
