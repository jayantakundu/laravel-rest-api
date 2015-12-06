<?php namespace App\Http\Responses;

use League\Fractal\Manager as Fractal;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class Output {

    /**
     * Fractal library used for data presention and transformation.
     * 
     * @var League\Fractal\Manager
     */
    private $fractal;

    /**
     * Construct a new output manager with a fractal manager.
     * 
     * @param League\Fractal\Manager $fractal
     */
    public function __construct(Fractal $fractal) 
    {
        $this->fractal = $fractal;
    }

    public function asError($message, $statusCode)
    {
        return [
            'error' => [
                'status_code' => (int) $statusCode,
                'message'   => $message,
            ]
        ];
    }

    /**
     * Output a single item.
     * 
     * @param  mixed $item    
     * @param  mixed $transformer
     * @return array
     */
    public function asItemArray($item, $transformer)
    {
        $resource = new Item($item, $transformer);

        $root = $this->fractal->createData($resource);

        return $root->toArray();
    }

    /**
     * Output as a collection of items.
     * 
     * @param  mixed $collection    
     * @param  mixed $transformer
     * @return array
     */
    public function asCollectionArray($collection, $transformer)
    {
        $resource = new Collection($collection, $transformer);

        $root = $this->fractal->createData($resource);

        return $root->toArray();
    }


}