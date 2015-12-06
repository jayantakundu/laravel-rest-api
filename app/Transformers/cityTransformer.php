<?php
namespace App\Transformers;

use App\Models\cities;
use League\Fractal;

class CityTransformer extends Fractal\TransformerAbstract
{
    /**
     * @param cities $cities
     * @return array
     */
    public function transform(cities $cities)
    {
        return [
            'id'     => (int) $cities->id,
            'name'   => $cities->name,
            'code'   => $cities->code
        ];
    }
}