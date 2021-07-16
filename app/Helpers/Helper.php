<?php

namespace App\Helpers;

function getLastUpdatedData($data)
{
    $lastUpdatedTime = $data::orderBy('updated_at', 'desc')->first()->updated_at;
    if ($lastUpdatedTime != null) {
        return $lastUpdatedTime->diffForHumans();
    }
    return null;
}