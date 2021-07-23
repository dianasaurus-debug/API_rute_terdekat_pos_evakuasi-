<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
          return response()->json([
            'success' => false,
            'message' => $validator->errors(),
          ], 401);
        }
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $success['token'] = $user->createToken('si_tanggap_darurat',['user'])->accessToken;
        return response()->json([
          'success' => true,
          'token' => $success,
          'user' => $user
      ]);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
//            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!auth()->guard('user')->attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        config(['auth.guards.api.provider' => 'user']);
        $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
        $tokenResult = $user->createToken('si_tanggap_darurat',['user']);
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        if (auth()->guard('user-api')->user()) {
        $user = auth()->guard('user-api')->user()->token();
        $user->revoke();

            return response()->json([
              'success' => true,
              'message' => 'Logout successfully'
          ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        try {
            $user = auth()->guard('user-api')->user();
        } catch (AccessDeniedHttpException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi'
            ]);
        }
        return response()->json($user);
    }
}
