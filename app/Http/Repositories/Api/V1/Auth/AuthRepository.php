<?php

namespace App\Http\Repositories\Api\V1\Auth;

use App\Models\User;

class AuthRepository
{
  public function store(object $request): object
  {
    return User::create([
      'email' => $request->email,
      'password' => $request->password,
      'type' => $request->type
    ]);
  }
}
