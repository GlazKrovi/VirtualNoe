<?php

namespace App\Models;

interface IFood extends IItem
{
    public function calories() : int;
}
