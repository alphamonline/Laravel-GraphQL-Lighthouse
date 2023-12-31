<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('email', $args['email'])->first(); 

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provider creadentials are incorrect.'],
            ]);
        }

        return $user->createToken($args['device'])->plainTextToken;
    }
}
