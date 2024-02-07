<?php

namespace App\Services\User;

use App\Models\Designation;

class DesignationService
{
    /* find all resource */
    public static function findAll()
    { 
        return Designation::latest()->get();
    }
}
