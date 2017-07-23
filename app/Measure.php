<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'value',
        'type_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The type of the measure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Set the date of the measure from a d/m/Y formatted string.
     *
     * @param string $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    /**
     * The date of the measure as a formatted string.
     *
     * @return string Date with format d/m/Y
     */
    public function getDateAttribute()
    {
        $date = $this->attributes['date'];
        if ($date instanceof Carbon) {
            $date = $date->format('Y-m-d');
        }

        return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }
}
