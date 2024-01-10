<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface IPlayer 
{
    public function name() : string;
    public function password() : string;
    public function level() : int;
    public function money() : int;
    public function quantity(IItem $item) : int;
    public function items();
    public function creature() : HasMany;

    public function setLevel(int $level): void;
    public function setMoney(int $money): void;
}
