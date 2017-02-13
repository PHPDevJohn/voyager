<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $guarded = [];

    public function link($absolute = false)
    {
        if (! is_null($this->route)) {
            return route($this->route, $this->getParametersAttribute(), $absolute);
        }

        if ($absolute) {
            return url($this->url);
        }

        return $this->url;
    }

    public function getParametersAttribute()
    {
        return json_decode($this->attributes['parameters']);
    }

    public function setParametersAttribute($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        
        $this->attributes['parameters'] = $value;
    }
}
