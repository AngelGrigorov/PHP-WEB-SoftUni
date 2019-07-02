<?php

namespace Database;

interface ResultSetInterface
{
    public function fetch($className) : \Generator;
    public function fetchAssoc() : \Generator;
}