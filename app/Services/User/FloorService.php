<?php

namespace App\Services\User;

use App\Models\Floor;

class FloorService
{
    /* find all resource */
    public static function findAll()
    {
        return Floor::latest()->get();
    }
}
