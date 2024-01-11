<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creature extends Model implements ICreature
{
    use HasFactory;

    protected $timestamp = false;

    protected $fillable = [
        'name',
        'life',
        'level',
        'hunger',
        'stamina',
    ];
    
    public const MAX_LEVEL = 1000;
    public const MAX_LIFE = 100;
    public const MAX_STAMINA = 100;
    public const MAX_HUNGER = 100;

    public function id() : string
    {
        return $this->id;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function life() : int
    {
        return $this->life;
    }

    public function level() : int
    {
        return $this->level;
    }

    public function hunger() : int
    {
        return $this->hunger;
    }

    public function stamina() : int
    {
        return $this->stamina;
    }

    /**
     * @return string Texture path
     */
    public function texture() : string
    {
        return 'images/creature_textures/' . $this->name();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
