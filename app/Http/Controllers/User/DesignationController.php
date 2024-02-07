<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\DesignationService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    use HttpResponseTrait;

    /** reosurce list */
    public function index()
    {
        $data = DesignationService::findAll();
        return $this->HttpSuccessResponse("Designation list", $data, 200);
    }
}
