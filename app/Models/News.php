<?php

namespace App\Models;

class News extends BaseModel
{
    const ACTIVE_STATUS = 'active';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'title',
        'body',
    ];

    public function scopeByFilter($query, string $filter = null)
    {
        return $query->when(isset($filter) && !empty($filter), function ($when) use ($filter) {
            $when->whereLike('title', $filter);
        });
    }
}
