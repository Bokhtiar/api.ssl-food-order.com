<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Traits\HttpResponseTrait;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserPermission
{
    use HttpResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('Authorization');

            if (!$token) {
                $errorArray = ['Token not found.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
            
            $user = JWTAuth::parseToken()->authenticate($token);    
            /* check role */
            if ($user->role == "user") {
                return $next($request);
            } else {
                $errorArray = ['Invalid Role Permission.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
        } catch (Exception $e) {
            $errorArray = [$e->getMessage()];
            return $this->HttpErrorResponse(array($errorArray), 404);
        }
    }
}
