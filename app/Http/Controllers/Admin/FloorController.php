<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\FloorService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    use HttpResponseTrait;
    /** Display a listing of the resource. */
    public function index()
    {
        try {
            $data = FloorService::findAll();
            return $this->HttpSuccessResponse('Floor items', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Store a newly created resource in storage. */
    public function store(Request $request)
    {
        try {
            $data = FloorService::store($request);
            return $this->HttpSuccessResponse('Floor ', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** Display the specified resource. */
    public function show(string $id)
    {
        try {
            $data = FloorService::findById($id);
            return $this->HttpSuccessResponse('Floor ', $data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**Update the specified resource in storage. */
    public function update(Request $request, string $id)
    {
        try {
            FloorService::update($id, $request);
            return $this->HttpSuccessResponse('Floor ', "Floor updated successfully done", 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* Remove the specified resource from storage. */
    public function destroy(string $id)
    {
        try {
            FloorService::findById($id)->delete();
            return $this->HttpSuccessResponse('Floor ', "Floor delete successfully done", 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
