<?php

namespace App\Models;

use App\Models\Clothe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function clothes()
    {
        return $this->hasMany(Clothe::class);
    }
}
