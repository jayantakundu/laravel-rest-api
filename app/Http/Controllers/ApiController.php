<?php namespace App\Http\Controllers;

use EllipseSynergie\ApiResponse\Contracts\Response;

class ApiController extends Controller {

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

}