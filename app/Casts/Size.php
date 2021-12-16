<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Size implements CastsAttributes
{
    private $sizes = ['xs', 's', 'm', 'l', 'xl', 'xxl'];

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        dd($model, $key, $value, $attributes);
        if (count($value) === 6) {
            return [true, true, true, true, true, true, true];
        }
        $size = [];

        return $size;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        array_shift($value);
        $sizes = [];
        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i]) {
                $sizes[] = $this->sizes[$i];
            }
        }
        // dd($model, $key, $value, $attributes, $sizes);
        return [$sizes];
    }
}
