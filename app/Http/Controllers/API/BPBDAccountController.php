<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bpbd;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Exceptions\MissingScopeException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BPBDAccountController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] nip
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:bpbd',
            'username' => 'required|string|unique:bpbd',
            'email' => 'required|string|email|unique:bpbd',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $user = Bpbd::create([
            'nip' => $request->nip,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $success['token'] = $user->createToken('si_tanggap_darurat',['bpbd'])->accessToken;
        return response()->json([
            'success' => true,
            'token' => $success,
            'bpbd' => $user
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
        if(!auth()->guard('bpbd')->attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        config(['auth.guards.api.provider' => 'bpbd']);
        $user = Bpbd::select('bpbd.*')->find(auth()->guard('bpbd')->user()->id);
        $tokenResult = $user->createToken('si_tanggap_darurat',['bpbd']);
        $token = $tokenResult->token;

        $token->save();
        return response()->json([
            'success' => true,
            'bpbd' => $user,
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
        if (auth()->guard('bpbd-api')->user()) {
            $user = auth()->guard('bpbd-api')->user()->token();
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
            $user = auth()->guard('bpbd-api')->user();
        } catch (AccessDeniedHttpException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi'
            ]);
        }
        return response()->json($user);
    }
}
