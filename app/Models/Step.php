<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Step extends Model
{
    protected $fillable = ['form_id', 'title', 'order'];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class)->orderBy('order');
    }
}
