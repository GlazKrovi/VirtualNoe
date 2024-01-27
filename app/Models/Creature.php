<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creature extends Model implements ICreature
{
    use HasFactory;

    protected $fillable = [
        'name',
        'life',
        'level',
        'hunger',
        'stamina',
        'species',
    ];
    
    public const MAX_LEVEL = 1000;
    public const MAX_LIFE = 100;
    public const MAX_STAMINA = 100;
    public const MAX_HUNGER = 100;

    public function id() : int
    {
        return $this->id;
    }

    public function name() : string
    {
        return $this->attributes['name']; 
    }

    public function life() : int
    {
        return $this->attributes['life']; 
    }

    public function level() : int
    {
        return $this->attributes['level']; 
    }

    public function hunger() : int
    {
        return $this->attributes['hunger']; 
    }

    public function stamina() : int
    {
        return $this->attributes['stamina']; 
    }

    // SETTER
    public function setLife(int $life)
    {
        $this->life = $life;
        if ($this->life > $this->MAX_LIFE) $this->life = $this->life;
        $this->save();
    }

    public function setLevel(int $level)
    {
        $this->level = $level;
        if ($this->level > $this->MAX_LEVEL) $this->level = $this->level;
        $this->save();
    }

    public function setHunger(int $hunger)
    {
        $this->hunger = $hunger;
        if ($this->hunger > $this->MAX_HUNGER) $this->hunger = $this->hunger;
        $this->save();
    }

    public function setStamina(int $stamina)
    {
        $this->stamina = $stamina;
        if ($this->stamina > $this->MAX_STAMINA) $this->stamina = $this->stamina;
        $this->save();
    }

    /**
     * @return string Texture path
     */
    public function texture() : string
    {
        return asset('textures/' . strtolower($this->species() . '.png'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function species() : string
    {
        return $this->attributes['species'];
    }

}