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
    ];
    
    public const MAX_LEVEL = 1000;
    public const MAX_LIFE = 100;
    public const MAX_STAMINA = 100;
    public const MAX_HUNGER = 100;

    public function id() : string
    {
        return $this->attributes['id'];
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
