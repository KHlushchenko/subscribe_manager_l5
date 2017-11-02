<?php

namespace Vis\SubscribeManager;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'vis_subscribers';

    protected $fillable = [
        'email',
        'lang',
        'is_active',
    ];

    public function entities()
    {
        return $this->belongsToMany('Vis\SubscribeManager\SubscribeEntity', 'vis_subscribers2vis_subscribe_entities');
    }

    public function scopeFilterEntitySlug($query, $entitySlug)
    {
        if ($entitySlug) {
            return $query->whereHas('entities', function ($q) use ($entitySlug) {
                $q->bySlug($entitySlug);
            });
        }

        return $query;
    }

    public function scopeFilterEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeFilterLang($query, $lang)
    {
        if ($lang) {
            $query->where('lang', $lang);
        }

        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

}
