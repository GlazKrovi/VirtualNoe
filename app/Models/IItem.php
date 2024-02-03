<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface IItem 
{
    public function id() : int;
    public function name() : string;
    public function type() : string;
    public function price() : int;
    public function users() : BelongsToMany;
}
