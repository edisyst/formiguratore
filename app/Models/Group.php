<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = ['step_id', 'title', 'header', 'footer', 'order'];

    public function step(): BelongsTo
    {
        return $this->belongsTo(Step::class);
    }

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class)->orderBy('order');
    }
}
