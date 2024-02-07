<?php

namespace App\Services\Admin;

use App\Models\Floor;

class FloorService
{
    /* find all resource */
    public static function findAll()
    {
        return Floor::latest()->get();
    }

    /* store resoruce documents */
    public static function storeDocument($request)
    {
        return array(
            'name' => $request->name,
            );
    }

    /* new store resource docuemnt */
    public static function store($request)
    {
        return Floor::create(FloorService::storeDocument($request));
    }

    /* specific reosurce show */
    public static function findById($id)
    {
        return Floor::find($id);
    }

    /* specific reosurce update */
    public static function update($id, $request)
    {
        $Floor = FloorService::findById($id);
        return $Floor->update(FloorService::storeDocument($request));
    }
}
