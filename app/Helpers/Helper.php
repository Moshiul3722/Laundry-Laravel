<?php

namespace App\Helpers;

class Helper
{
    function getMyText()
    {
        return "Order No.-00001";
    }


    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function OrderNumberGenerator($model, $trow, $length = 4, $prefix)
    {
        $last_number = '';
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actual_last_number = ($code / 1) * 1;
            $increment_last_number = $actual_last_number + 1;
            $last_number = strlen($increment_last_number);
            $og_length = $length - $last_number;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . $zeros . $last_number;
    }
}
