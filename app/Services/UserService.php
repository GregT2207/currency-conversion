<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function create($data): User
    {
        $processed = [];
        foreach ($data as $key => $value) {
            $processed[Str::snake($key)] = $value;
        }
        
        $user = User::create($processed);

        return $user;
    }
}