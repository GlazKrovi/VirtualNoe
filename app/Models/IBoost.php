<?php

namespace App\Models;

interface IBoost extends IItem
{
    public function energy() : int;
}
