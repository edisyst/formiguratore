<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends Model
{
    protected $fillable = [
        'step_id', 'name', 'type', 'label', 'placeholder',
        'required', 'order', 'configuration',
    ];

    protected $casts = [
        'required' => 'boolean',
        'configuration' => 'array',
    ];

    public function step(): BelongsTo
    {
        return $this->belongsTo(Step::class);
    }

    public function objectRecords(): HasMany
    {
        return $this->hasMany(ObjectRecord::class);
    }
}
