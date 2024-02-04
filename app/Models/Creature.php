<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

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

    protected const MAX_LEVEL = 1000;
    protected const MAX_LIFE = 100;
    protected const MAX_STAMINA = 100;
    protected const MAX_HUNGER = 100;
    protected const MIN_INFO_VALUE = 0;

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->attributes['name'];
    }

    public function life(): int
    {
        return $this->attributes['life'];
    }

    public function level(): int
    {
        return $this->attributes['level'];
    }

    public function hunger(): int
    {
        return $this->attributes['hunger'];
    }

    public function stamina(): int
    {
        return $this->attributes['stamina'];
    }

    // SETTER
    public function levelUp(int $experience): void
    {
        $this->level += $experience;
        if ($this->level > $this->MAX_LEVEL) $this->level = $this->MAX_LEVEL;
        $this->save();
    }

    public function feed(int $calories): void
    {
        $this->hunger += $calories;
        if ($this->hunger > $this->MAX_HUNGER) $this->hunger = $this->MAX_HUNGER;
        $this->save();
    }

    public function makeHungry(int $calories): void
    {
        $this->hunger -= $calories;
        if ($this->hunger < $this->MIN_INFO_VALUE) $this->hunger = $this->MIN_INFO_VALUE;
        $this->save();
    }

    public function boost(int $energy): void
    {
        $this->stamina += $energy;
        if ($this->stamina > $this->MAX_ENERGY) $this->stamina = $this->MAX_ENERGY;
        $this->save();
    }

    public function tires(int $energy): void
    {
        $this->stamina -= $energy;
        if ($this->stamina < $this->MIN_INFO_VALUE) $this->stamina = $this->MIN_INFO_VALUE;
        $this->save();
    }

    public function heal(int $life): void
    {
        if ($life < 0) throw new InvalidArgumentException('Invalid value');
        $this->life += $life;
        if ($this->life > $this->MAX_LIFE) $this->life = $this->MAX_LIFE;
        $this->save();
    }

    public function hurt(int $life): void
    {
        if ($life > 0) throw new InvalidArgumentException('Invalid value');
        $this->life -= $life;
        if ($this->life < $this->MIN_INFO_VALUE) $this->life = $this->MIN_INFO_VALUE;
        $this->save();
    }

    /**
     * @return string Texture path
     */
    public function texture(): string
    {
        return asset('textures/' . strtolower($this->species() . '.png'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function species(): string
    {
        return $this->attributes['species'];
    }
}
