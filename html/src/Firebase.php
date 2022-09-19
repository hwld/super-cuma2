<?php

namespace App;

class Firebase
{
    /**
     * @return string
     */
    public static function getServiceAccountPath()
    {
        return __DIR__ . '/../super-cuma-firebase-adminsdk.json';
    }
}
