<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface IPlayer extends IUser
{
    public function level(): int;
    public function money(): int;
    public function items(): BelongsToMany;
    public function creatures(): HasMany;

    public function setLevel(int $level): void;
    public function setMoney(int $money): void;
}
