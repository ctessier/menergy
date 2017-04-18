<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
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
     * The date of the measure as a formatted string.
     *
     * @return string
     */
    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->format('d/m/Y');
    }
}
