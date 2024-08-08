<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws InvalidCredentialsException
     */
    public function login(string $email, string $password)
    {
        $credentials = ['email' => $email, 'password' => $password];
        if (!$token = Auth::attempt($credentials)) {
            throw new InvalidCredentialsException();
        }

        return $this->formatToken($token);
    }

    /**
     *
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * @return array
     */
    public function refreshAccessToken()
    {
        $token = Auth::refresh();
        return $this->formatToken($token);
    }

    /**
     * @return array
     */
    public function getAuthUser()
    {
        return Auth::user()->toArray();
    }

    /**
     * @param string $token
     * @return array
     */
    protected function formatToken(string $token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
