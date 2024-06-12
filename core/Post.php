<?php

namespace core;

class Post extends ReguestMethod
{
   public function __construct()
   {
       parent::__construct($_POST);
   }
}