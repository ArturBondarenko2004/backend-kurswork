<?php

namespace core;

use core\ReguestMethod;

class Get extends ReguestMethod
{
    public function __construct()
    {
        parent::__construct($_GET);
    }
}