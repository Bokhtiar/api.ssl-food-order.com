<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\FloorService;
use App\Traits\HttpResponseTrait;

class FloorController extends Controller
{
    use HttpResponseTrait;

    /** reosurce list */
    public function index()
    {
        $data = FloorService::findAll();
        return $this->HttpSuccessResponse("Floor list", $data, 200);
    }
}
