<?php namespace App\Http\Controllers;

use App\Http\Responses\Output;

use Illuminate\Http\Response;

use UnexpectedValueException;
use Illuminate\Http\Exception;

class ApiController extends Controller {

    /**
     * An output class for sending expected outputs.
     *
     * @var App\Http\Responses\Output
     */
    private $output;

    /**
     * Current status code of the given request.
     *
     * @var integer
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * Make a new api controller with an output class.
     *
     * @param App\Http\Responses\Output $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Get the current status code.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status code.
     *
     * @return integer
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Respond with a json array.
     *
     * @param  array  $array
     * @param  array  $headers
     * @return Illuminate\Http\Response
     */
    protected function respondWithArray(array $array, array $headers = array())
    {
        return response()->json($array, 200, $headers);
    }

    /**
     * Respond with an error.
     *
     * @param  stirng $message
     * @param  stirng $errorCode
     * @return Illuminate\Http\Response
     */
    protected function respondWithError($message)
    {

        $out = $this->output->asError($message, $this->statusCode);

        return $this->respondWithArray($out);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInernalServerErrror($message = 'Inernal Server Errror!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * Respond with a single item.
     *
     * @param  mixed $item
     * @param  mixed $transformer
     * @return Illuminate\Http\Response
     */
    protected function respondWithItem($item, $transformer)
    {
        $out = $this->output->asItemArray($item, $transformer);

        return $this->respondWithArray($out);
    }

    /**
     * Respond with a collection of items.
     *
     * @param  array $collection
     * @param  mixed $transformer
     * @return Illuminate\Http\Response
     */
    protected function respondWithCollection($collection, $transformer)
    {
        $out = $this->output->asCollectionArray($collection, $transformer);

        return $this->respondWithArray($out);
    }

}