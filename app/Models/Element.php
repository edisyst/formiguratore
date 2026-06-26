<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Element extends Model
{
    protected $fillable = [
        'group_id', 'uuid', 'name', 'type', 'label', 'placeholder',
        'required', 'order', 'configuration',
    ];

    protected $casts = [
        'required' => 'boolean',
        'configuration' => 'array',
    ];

    public function save(array $options = []): bool
    {
        if (! $this->exists && empty($this->uuid)) {
            $this->uuid = (string) Str::uuid();
        }

        return parent::save($options);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function objectRecords(): HasMany
    {
        return $this->hasMany(ObjectRecord::class);
    }
}
