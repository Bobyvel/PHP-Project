<?php

namespace App\DTO;


class DTOValidator
{
    public static function validate($min, $max, $value, $errorMessage){

        if (strlen($value) < $min || strlen($value) > $max ){
            throw new \Exception($errorMessage);
        }
    }
}