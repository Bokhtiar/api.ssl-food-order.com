<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DesignationService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    use HttpResponseTrait;
    /** Display a listing of the resource. */
    public function index()
    {
        try {
            $data = DesignationService::findAll();
            return $this->HttpSuccessResponse('Designation items', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Store a newly created resource in storage. */
    public function store(Request $request)
    {
        try {
            $data = DesignationService::store($request);
            return $this->HttpSuccessResponse('Designation ', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Display the specified resource. */
    public function show(string $id)
    {
        try {
            $data = DesignationService::findById($id);
            return $this->HttpSuccessResponse('Designation ', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**Update the specified resource in storage. */
    public function update(Request $request, string $id)
    {
        try {
            DesignationService::update($id,$request);
            return $this->HttpSuccessResponse('Designation ',"Designation updated successfully done", 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* Remove the specified resource from storage. */
    public function destroy(string $id)
    {
        try {
            DesignationService::findById($id);
            return $this->HttpSuccessResponse('Designation ', "Designation delete successfully done", 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
