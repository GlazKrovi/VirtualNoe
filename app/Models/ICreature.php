<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface ICreature 
{
    function id() : int;
    function name() : string;
    function life() : int;
    function level() : int;
    function hunger() : int;
    function stamina() : int;
    function species() : string;

    function setLife(int $life);
    function setLevel(int $level);
    function setHunger(int $hunger);
    function setStamina(int $stamina);

    function user() : BelongsTo;

    /**
     *
     * @return string Texture path
     */
    function texture() : string;
}
