<?php
namespace App\Transformers;

use App\Models\regions;
use League\Fractal;

class RegionTransformer extends Fractal\TransformerAbstract
{
    /**
     * @param regions $regions
     * @return array
     */
    public function transform(regions $regions)
    {
        return [
            'id'     => (int) $regions->id,
            'name'   => $regions->name,
            'code'   => $regions->code
        ];
    }
}