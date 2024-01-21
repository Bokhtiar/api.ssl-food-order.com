<?php

namespace App\Services\Admin;

use App\Models\Designation;

class DesignationService
{
    /* find all resource */
    public static function findAll()
    {
        return Designation::latest()->get();
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
        return Designation::create(DesignationService::storeDocument($request));
    }

    /* specific reosurce show */
    public static function findById($id)
    {
        return Designation::find($id);
    }

    /* specific reosurce update */
    public static function update($id, $request)
    {
        $designation = DesignationService::findById($id);
        return $designation->update(DesignationService::storeDocument($request));
    }
}
