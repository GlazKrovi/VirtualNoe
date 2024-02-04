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

/*
 + levelUp(creatureId : Integer, experience : Integer)
        + feed(creatureId : Integer, calories : Integer) /' + '/
        + makeHungry(creatureId : Integer, calories : Integer) /' - '/
        + boost(creatureId : Integer, energy : Integer) /' + '/
        + tires(creatureId : Integer, energy : Integer) /' - '/
        + heal(creatureId : Integer, life : Integer) /' + '/
        + hurt(creatureId : Integer, life : Integer) /' - '/ */