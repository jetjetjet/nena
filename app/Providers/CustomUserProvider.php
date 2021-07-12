<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\AuditTrailRepository;

use DB;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        $user = User::where('id', $identifier)->first();
        return $user;
    }

    public function retrieveByToken($identifier, $token)
    {
    }
    
    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        $result = [];
        $email =  $credentials['email'];
        $password =  $credentials['password'];
        $user = User::where('email', $email)->first();
        if ($user === null || !Hash::check($password, $user['password'])){
            return null;
        };
        return $user;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if ($user === null) return false;
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}
