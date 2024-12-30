<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    /**
    * Handle user login for API.
    * @OA\Info(
    *     version="1.0.0",
    *     title="MedShop API",
    *     description="API documentation for MedShop application",
    *     @OA\Contact(
    *         email="support@medshop.com"
    *     ),
    *     @OA\License(
    *         name="Apache 2.0",
    *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
    *     )
    * )
    * @OA\Post(
    *     path="/api/login",
    *     summary="User Login",
    *     description="Authenticate a user and return an access token",
    *     operationId="loginUser",
    *     tags={"Authentication"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email","password"},
    *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
    *             @OA\Property(property="password", type="string", format="password", example="password123")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Login successful",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Login successful"),
    *             @OA\Property(property="user", type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="John Doe"),
    *                 @OA\Property(property="email", type="string", format="email", example="user@example.com"),
    *             ),
    *             @OA\Property(property="token", type="string", example="1|fZmWyk...qX")
    *         )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation Error",
    *         @OA\JsonContent(
    *             @OA\Property(property="error", type="object",
    *                 @OA\Property(property="email", type="array", @OA\Items(type="string")),
    *                 @OA\Property(property="password", type="array", @OA\Items(type="string"))
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized. Invalid credentials.",
    *         @OA\JsonContent(
    *             @OA\Property(property="error", type="string", example="Unauthorized. Invalid credentials.")
    *         )
    *     )
    * )
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // If validation fails, return a 422 error with validation messages
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // Attempt login with the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Generate a token for the user (Optional if you are using Sanctum or Passport)
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Return success response with the token and user info
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If authentication fails, return an error response
        return response()->json([
            'error' => 'Unauthorized. Invalid credentials.'
        ], 401);
    }
}