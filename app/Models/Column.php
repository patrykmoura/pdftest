<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Column extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class)
            ->withPivot('content')
            ->withTimestamps();
    }
}
