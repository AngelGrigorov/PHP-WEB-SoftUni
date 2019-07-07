<?php

namespace App\Data;


class DTOValidator
{
    /**
     * @param $min
     * @param $max
     * @param $value
     * @param $type
     * @param $fieldName
     * @throws \Exception
     */
    public static function validate($min, $max, $value, $type, $fieldName)
    {

        if ($type === "text") {
            if (mb_strlen($value) < $min || mb_strlen($value) > $max) {
                throw new \Exception("{$fieldName} must be between $min and $max characters!");
            }
        } else if ($type == "number") {
            if (is_numeric($value)) {
                if ($value < $min || $value > $max) {
                    throw new \Exception("{$fieldName} must be between $min and $max!");
                }
            } else {
                throw new \Exception("Please enter a number!");
            }
        } else if ($type == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Please enter a valid email!');
            }
        } else if($type == "days") {
            if(!filter_var($value, FILTER_VALIDATE_INT)) {
                throw new \Exception("Days must be integer!");
            }
            if ($value < $min || $value > $max || $value < 1) {
                throw new \Exception("{$fieldName} must be between $min and $max!");
            }
        } else if($type == "price") {
            if($value < 0) {
                throw new \Exception("Price must be positive number!");
            }
            if ($value < $min || $value > $max || $value < 1) {
                throw new \Exception("{$fieldName} must be between $min and $max!");
            }
        }

    }
}
