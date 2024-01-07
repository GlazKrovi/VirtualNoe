<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\InventoryController;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $DEFAUL_MONEY = 50;
    protected InventoryController $inventoryController;

    public function __construct(InventoryController $inventoryController)
    {
        $this->middleware('guest');
        $this->inventoryController = $inventoryController;
    }

    protected function create(array $data)
    {
        // Create new user
        $user = User::createWithItems([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => 0,
            'money' => $this->DEFAUL_MONEY,
        ]);
        return $user;
    }
}
