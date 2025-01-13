<?php 

namespace App\Helpers;

class AWBNumber
{
    public static function generateAWBNumber()
    {
        return str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
    }
}