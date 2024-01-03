<?php

namespace App\Models;

interface IPlayer 
{
    public function login() : string;
    public function password() : string;
    public function level() : int;
    public function money() : int;
    public function quantityOf(IItem $item) : int;

    /**
     * @return Illuminate\Database\Eloquent\Collection|\App\Models\Item[]
     */
    public function itemsOfType(IItem $type) : array;
}
