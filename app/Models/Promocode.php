<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promocodes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $appends = array('isActive', 'nb_days_expired', 'created_at');

    public function getIsActiveAttribute()
    {
        return Carbon::parse($this->expires_at)->setTimezone('Africa/Algiers')->isFuture();
    }

    public function getNbDaysExpiredAttribute(): int
    {
        return $this->data->nb_days_expired;
    }

    public function getCreatedAtAttribute()
    {
        return $this->data->created_at;
    }

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
