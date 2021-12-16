<?php

namespace App\Models;

use App\Casts\Size;
use App\Models\ClotheImage;
use App\Models\Marque;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Clothe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'marque_id',
        'name',
        'slug',
        'size',
        'qte',
        'is_enabled',
        'nb_added',
        'colors',
        'price',
        'is_sale',
        'sale',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'size' => Size::class,
        'size' => 'array',
        'colors' => 'array',
        'qte' => 'integer',
        'is_enabled' => 'boolean',
        'nb_added' => 'integer',
        'price' => 'float',
        'is_sale' => 'boolean',
        'sale' => 'float',
        'marque_id' => 'integer',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function setSizeAttribute($value)
    {
        array_shift($value);
        $sizes_default = ['xs', 's', 'm', 'l', 'xl', 'xxl'];
        $sizes = [];
        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i]) {
                $sizes[] = $sizes_default[$i];
            }
        }
        $this->attributes['size'] = json_encode($sizes);
    }

    public function getSizeAttribute($value)
    {
        $values = json_decode($value, true);
        if (count($values) === 0) {
            return [false, false, false, false, false, false, false];
        }
        if (count($values) === 6) {
            return [true, true, true, true, true, true, true];
        }
        $sizes_bool_default = [false, false, false, false, false, false, false];
        $sizes_default = ['Tous', 'xs', 's', 'm', 'l', 'xl', 'xxl'];

        for ($i=0; $i < count($sizes_default); $i++) {
            if (in_array($sizes_default[$i], $values)) {
                $sizes_bool_default[$i] = true;
            }
        }

        return $sizes_bool_default;
    }

    public function images()
    {
        return $this->hasMany(ClotheImage::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
}
