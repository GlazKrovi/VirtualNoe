<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Collection;

interface IPlayer 
{
    public function login() : string;
    public function password() : string;
    public function level() : int;
    public function money() : int;
    public function quantity(IItem $item) : int;
    public function add(Item $item, int $quantity);
    public function remove(Item $item, int $quantity);
    public function items() : Collection;
}
