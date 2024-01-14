<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface ICreature 
{
    public function name() : string;
    public function life() : int;
    public function level() : int;
    public function hunger() : int;
    public function stamina() : int;
    public function owner() : BelongsTo;

    /**
     *
     * @return string Texture path
     */
    public function texture() : string;
}
