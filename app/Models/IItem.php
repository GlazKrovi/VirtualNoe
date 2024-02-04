<?php

namespace App\Models;

use App\Models\UseStrategy\UseStrategy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface IItem 
{
    public function id() : int;
    public function name() : string;
    public function type() : string;
    public function price() : int;
    public function usage() : UseStrategy;
    public function users() : BelongsToMany;
}