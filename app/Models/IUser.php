<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InventoryController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface IUser 
{
    public function id() : int;
    public function name() : string;
    public function password() : string;
    public function email() : string;
}
