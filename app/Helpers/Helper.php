<?php

namespace App\Helpers;

function getLastUpdatedData($table)
{
    $data = $table::orderBy('updated_at', 'desc')->first();

    if ($data && $data->updated_at) {
        return $data->updated_at->diffForHumans();
    }

    return null;
}
