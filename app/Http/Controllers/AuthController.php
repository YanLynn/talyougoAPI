<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Profile;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client as GuzzleClient;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $credentials = request(['phone', 'password']);
        
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised'],401);
            
        } else {
            $auth = Auth::user();
            $profile = Profile::where('user_id', $auth->id)->first();
            // $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['token'] = $token;
            $success['user'] =  $auth;
            $success['profile'] = $profile;
            
            return $this->handleResponse($success, 'User logged-in!');
        }
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $uniquePhone =  User::where('phone', $request->phone)->first();
        if ($uniquePhone) {
            return $this->handleError('phone number already exists!!');
        }

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $user = User::create(
            array_merge(
                $validator->validated(),
                [
                    'password' => bcrypt($request->password),
                    'role_id'  => 1, // default
                    'trial_paid' => 0, // default
                ]
            )
        );

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);
        $token = JWTAuth::attempt(['phone' => $request->phone, 'password' => $request->password]);
        // $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['token'] = $token;
        $success['user'] =  $user;
        $success['profile'] = $profile;
        return $this->handleResponse($success, 'User successfully registered!');
    }



    public function refresh(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'access_token' => Auth::guard('api')->refresh(),
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->handleResponse('success', 'delete token!');
    }

    public function getUser()
    {
        return response()->json(Auth::guard()->user());
    }


    public function redirectToProvider($provider)
    {

        $validated = $this->validateProvider($provider);

        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
        // dd($user);
        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'password' => bcrypt('P@ssw0rd'),
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        // $token = $userCreated->createToken('token-name')->plainTextToken;
        //get facebook token
        $token = Socialite::driver('facebook')->user()->token;

        return response()->json(['Access-Token' => $token, 'login-user' => $userCreated,], 200);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    // using only facebook
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }

    public function loginWithFacebook(Request $request)
    {

        $fbUser = User::updateOrCreate([
            'email' => $request->email,
            'name' => $request->name,
            'role_id' => 1,
            'trial_paid' => 0,
        ]);
        $profile = Profile::updateOrCreate([
            'user_id' => $fbUser->id,
        ]);
        $token =JWTAuth::attempt($fbUser);
        // $success['token'] =  $fbUser->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['token'] = $token;
        $success['user'] =  $fbUser;

        return $this->handleResponse($success, 'User successfully registered!');
    }


    public function sendOTP()
    {
        

        $response = Http::post('https://smspoh.com/api/v2/send', [
            'to' => '09766646093',
            'message' => 'testing opt',
            'sender' => 'agga'
        ]);
        $headers = [
            'Content-Type' => 'application/json',
            'AccessToken' => 'key',
            'Authorization' => 'Bearer token',
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);
        
        // $body = '{
        //     "key1" : '.$value1.',
        //     "key2" : '.$value2.',
        // }';
        
        $r = $client->request('POST', 'http://example.com/api/postCall', [
            //'body' => $body
        ]);
        $response = $r->getBody()->getContents();

        return $response;
    }



}
