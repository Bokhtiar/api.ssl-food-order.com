<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Traits\HttpResponseTrait;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    use HttpResponseTrait;

    /* login */
    public function login(AuthRequest $request)
    {
        /* check exist email */
        $existCredintial = User::where('email', $request->email)->first();
        if (!$existCredintial) {
            $errorArray = ['Invalid login credentials.'];
            return $this->HttpErrorResponse(array($errorArray), 404);
        }

        /* check exist password */
        if (!Hash::check($request->password, $existCredintial->password)) {
            $errorArray = ['Invalid login credentials.'];
            return $this->HttpErrorResponse(array($errorArray), 404);
        }

        /* check role */
        $checkRole = User::where('role', $existCredintial->role)->first();
        if (!$checkRole) {
            $errorArray = ['Invalid login credentials.'];
            return $this->HttpErrorResponse(array($errorArray), 404);
        }
        
        if ("user" == $existCredintial->role) {
            
        }else{
            $errorArray = ['Invalid login credentials.'];
            return $this->HttpErrorResponse(array($errorArray), 404);
        }

        $credentials = $request->only('email', 'password');

        $token = auth()->claims([
            'id' => $checkRole->id,
            'name' => $checkRole->name,
            'permissions' => json_decode($checkRole),
        ])->attempt($credentials);

        return $this->createNewToken($token);
    }
 
    /* register credintial */
    public function register(RegistrationRequest $request)
    {
        $existUser = User::where('email', $request->email)->first();
        if($existUser){
            return $this->HttpErrorResponse("Already singup please login", 422);
        }
        try {
            $data = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'floor_id' => $request->floor_id,
                'designation_id' => $request->designation_id,
                'seat' => $request->seat,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            return $this->HttpSuccessResponse("Registrtion successfully done.", $data, 201);
        } catch (\Throwable $th) {
            return $this->HttpErrorResponse($th->getMessage(), 404);
        }
    }

    /* create token generate exp date */
    protected function createNewToken($token)
    {
        $response_data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];

        return response()->json([
            'status' => 'false',
            'data' => $response_data,
        ], 200);
    }
}
