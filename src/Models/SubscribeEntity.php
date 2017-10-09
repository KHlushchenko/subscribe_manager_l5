<?php

namespace Vis\SubscribeManager;

use Illuminate\Database\Eloquent\Model;

class SubscribeEntity extends Model
{
    use \Vis\Builder\Helpers\Traits\TranslateTrait;

    protected $table = 'vis_subscribe_entities';

    public function subscribers()
    {
        return $this->belongsToMany('Vis\SubscribeManager\Subscriber', 'vis_subscribers2vis_subscribe_entities');
    }

    public function scopeFilterSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

}
