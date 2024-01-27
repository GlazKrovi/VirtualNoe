<?php

namespace App\Models;

interface IItem 
{
    public function id() : int;
    public function name() : string;
    public function type() : string;
    public function price() : int;
}
