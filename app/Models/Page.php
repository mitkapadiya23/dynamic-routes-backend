<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'content'
    ];

    /**
     * Parent page relationship.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Child pages relationship.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->with(['children', 'parent']);
    }
}
