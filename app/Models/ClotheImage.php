<?php

namespace App\Models;

use App\Models\Clothe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClotheImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image',
        'image_blur',
    ];

    public function getImageAttribute($value)
    {
        $img = 'clothes/'.$this->clothe->id.'/'.$value;

        return Storage::url($img);
    }

    public function getImageBlurAttribute($value)
    {
        $img = 'clothes/'.$this->clothe->id.'/'.$value;

        return Storage::url($img);
    }

    public function clothe()
    {
        return $this->belongsTo(Clothe::class);
    }
}
