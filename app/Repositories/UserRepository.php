<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private $user;

    public function __construct($user = null)
    {
        $this->user = $user ?? new User();
    }

    public function store(array $data)
    {
        $user = $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }
}