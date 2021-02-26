<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements \Laravel\Fortify\Contracts\LoginResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return Response
     */
    public function toResponse($request): Response
    {
        // Custom your response here.
        return $request->wantsJson()
            ? response()->json([
                'token' => $request->user()->createToken($request->input('device_name', 'web'))->plainTextToken,
                'two_factor' => false
            ])
            : redirect()->intended(config('fortify.home'));
    }
}
