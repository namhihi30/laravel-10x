<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;
use Laravel\Sanctum\PersonalAccessToken;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
//    public function login(Request $request)
//    {
//        $email = $request->email;
//        $password = $request->password;
//        $checkLogin = Auth::attempt([
//            'email' => $email,
//            'password' => $password,
//        ]);
//
//        if ($checkLogin) {
//            $user = Auth::user();
////            $token = $user->createToken('auth_token')->plainTextToken;
//
////            $tokenResult = $user->createToken('auth_api_passport');
////
////
////            //    Thiết lập expires_at
////            $token = $tokenResult->token;
////            $token->expires_at = Carbon::now()->addMinutes(30);
////
////
////            //     Trả về access token
////            $accessToken = $tokenResult->accessToken;
////
////            $expires = Carbon::parse($token->expires_at)->toDateTimeString();
//
//            $client = Client::where('password_client', 1)->first();
//            $clientId = $client->id;
//            $clientSecret = $client->secret;
//            $response = Http::asForm()->post('http://laravel_10x.test/oauth/token', [
//                'grant_type' => 'password',
//                'client_id' => $clientId,
//                'client_secret' => $clientSecret,
//                'username' => $email,
//                'password' => $password,
//                'scope' => '',
//            ]);
//
//            return $response;
//        } else {
//            $response = [
//                'statusCode' => 401,
//                'title' => 'Unauthorized',
//            ];
//        }
//
//        return $response;
//    }
//
//    public function logout()
//    {
//        $user = Auth::user()->token();
//        $status = $user->revoke();
//        $response = [
//            'statusCode' => 200,
//            'title' => 'Logout',
//        ];
//        return $response;
//    }
//
//    public function getToken(Request $request)
//    {
//        return $request->user()->currentAccessToken()->delete();
//    }
//
//    public function refreshToken(Request $request)
//    {
////        if ($request->header('authorization')) {
////            $hasToken = $request->header('authorization');
////            $hasToken = str_replace('Bearer', '', $hasToken);
////            $hasToken = trim($hasToken);
////            $token = PersonalAccessToken::findToken($hasToken);
////            if ($token) {
////                $tokenCreated = $token->created_at;
////                $expires = Carbon::parse($tokenCreated)->addMinutes(config('sanctum.expiration'));
////                if (Carbon::now() > $expires) {
////                    $userId = $token->tokenable_id;
////                    $user = User::find($userId);
////                    $user->tokens()->delete();
////                    $newToken = $user->createToken('auth_token')->plainTextToken;
////                    $response = [
////                        'statusCode' => 200,
////                        'newToken' => $newToken,
////                    ];
////                } else {
////                    $response = [
////                        'status' => 204,
////                        'title' => "Unexpired",
////                    ];
////                }
////            } else {
////                $response = [
////                    'statusCode' => 401,
////                ];
////            }
////        }
//        $client = Client::where('password_client', 1)->first();
//        if ($client) {
//            $clientId = $client->id;
//            $clientSecret = $client->secret;
//            $refreshToken = $request->refresh;
//            $response = Http::asForm()->post('http://laravel_10x.test/oauth/token', [
//                'grant_type' => 'refresh_token',
//                'refresh_token' => $refreshToken,
//                'client_id' => $clientId,
//                'client_secret' => $clientSecret,
//                'scope' => '',
//            ]);
//            return $response->json();
//        }
//
//    }


// JWT
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh_token']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $refreshToken = $this->createRefreshToken();
        return $this->respondWithToken($token, $refreshToken);
    }

    public function createRefreshToken()
    {
        $data = [
            'user_id' => auth('api')->user()->id,
            'random' => rand() . time(),
            'exp' => time() + config('jwt.refresh_ttl'),
        ];
        $refreshToken = JWTAuth::getJWTProvider()->encode($data);
        return $refreshToken;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        try {
            $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);
            $user = User::find($decoded['user_id']);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            auth()->invalidate();
            $token = auth('api')->login($user);
            $refreshToken = $this->createRefreshToken();
            return $this->respondWithToken($token, $refreshToken);
        } catch (JWTException $JWTException) {
            return response()->json(['error' => $JWTException]);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
