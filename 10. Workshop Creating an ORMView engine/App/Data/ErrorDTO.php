<?php

namespace App\Data;

class ErrorDTO
{
    private $message;

    /**
     * ErrorDTO constructor.
     * @param $message
     */
    public function  __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }


}