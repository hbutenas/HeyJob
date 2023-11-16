<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Events\Api\V1\Auth\CompanyProfileCreated;
use App\Events\Api\V1\Auth\UserProfileCreated;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\Api\V1\Auth\AuthRepository;

class AuthService
{

    use HttpResponses;

    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(object $request): object
    {
        // save email lowercased
        $request->email = strtolower($request['email']);

        // hash password
        $request->password = Hash::make($request['password']);

        // create user
        $user = $this->authRepository->store($request);

        // something went wrong while creating the user, throw error
        if (!$user) {
            return $this->failedRequest('', 'Something went wrong while creating the new user', 400);
        }

        // return successfully created user
        return $this->successfullRequest($user, 'User successfully created', 201);
    }

    public function login(object $request): object
    {

        // Validate user credentials
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->failedRequest('', 'Invalid email address or password', 400);
        }

        // Get authenticated user
        $user = Auth::user();

        // Create token
        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        if ($user->type === 'job_seeker' && !$user->profile) {
            // If it's a job seeker and their profile doesn't exists, create one
            event(new UserProfileCreated($user));

            // Prepare the response and message for job seekers
            $response = [
                'profile' => $user->profile,
                'token' => $token,
            ];

            $message = 'User profile is empty and is not created';
        } elseif ($user->type === 'employer' && !$user->company) {
            // If it's a employer and their company doesn't exists, create one
            event(new CompanyProfileCreated($user));

            // Prepare the response and message for employer
            $response = [
                'company' => $user->company,
                'token' => $token
            ];

            $message = 'User company is empty and is not created';
        } else {
            // Company or profile already exists, prepare a response for all users
            $response = [
                'user' => $user,
                'token' => $token,
            ];

            $message = 'User successfully logged in';
        }

        $cookie = cookie('auth_token', $token, 30, null, null, false, true, false, 'Lax');

        return $this->successfullRequest($response, $message, 200)->withCookie($cookie);
    }

    public function logout(): object
    {
        $token = Auth::user()->tokens()->latest()->first();

        // Check if a token exists (middleware should check this, but double check it)
        if (!$token) {
            return $this->failedRequest('', 'Unauthorized', 401);
        } else {
            // Delete token
            $token->delete();
            return $this->successfullRequest('', 'User successfully logged out', 200);
        }
    }

    public function user(): object
    {
        return $this->successfullRequest(Auth::user(), 'User successfully identified', 200);
    }
}
