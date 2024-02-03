<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface IPlayer extends IUser
{
    public function level() : int;
    public function money() : int;
    public function items();
    public function creatures() : HasMany;

    public function setLevel(int $level): void;
    public function setMoney(int $money): void;
}
