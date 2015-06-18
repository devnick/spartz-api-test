<?php

namespace Spartz;

use Illuminate\Database\Eloquent\Model;
use \DB;

class City extends Model
{
    /**
     * Query scope for locating related locations by distance
     *
     */
    public function scopeDistance($query, $distance)
    {
        $lat = $this->lat;
        $lng = $this->lng;
        $distance = is_numeric($distance) && $distance <= 100 ? $distance : 5;

        return $query->select(
            DB::raw("*,
                    ( 3959 * acos( cos( radians(?) ) *
                       cos( radians( lat ) ) *
                       cos( radians( lng ) - radians(?) ) +
                       sin( radians(?) ) *
                       sin( radians( lat ) ) )
                     ) AS distance"))
            ->having("distance", "<", $distance)
            ->orderBy("distance")
            ->setBindings([$lat, $lng, $lat])
            ->where('id', '!=', $this->id);
    }

    public function state()
    {
        return $this->belongsTo('Spartz\State');
    }

    public function scopeByCityName($query, $city)
    {
        return $query->where('name', '=', $city);
    }
}