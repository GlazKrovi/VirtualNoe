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

    // SETTER
    function levelUp(int $experience) : void;
    function feed(int $calories) : void;
    function makeHungry(int $calories) : void;
    function boost(int $energy) : void;
    function tires(int $energy) : void;
    function heal(int $life) : void;
    function hurt(int $life) : void;


    function user() : BelongsTo;

    /**
     *
     * @return string Texture path
     */
    function texture() : string;
}
