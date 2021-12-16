<?php

namespace App\Models;

use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'wilaya_id',
    ];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}
