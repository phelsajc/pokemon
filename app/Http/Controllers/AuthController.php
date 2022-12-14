<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->middleware('JWT', ['except' => ['login','signup','me','updateDetails']]);
    }
    //, ['except' => ['login','signup']]
    /**
     * Get a JWT via given credentials.
     *
      * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or Password Invalid'], 401);
        }

        return $this->respondWithToken($token);
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
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'email' => auth()->user()->email,
            'type' => auth()->user()->type,
            'firstname' => auth()->user()->firstname,
            'lastname' => auth()->user()->lastname,
            'birthdate' => auth()->user()->birthdate,
        ]);
    }

    public function signup(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'fname' => 'required',
            'lname'  => 'required',
            'bday'  => 'required',
            'username'  => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = array();
        $data['firstname'] = $request->fname;
        $data['lastname'] = $request->lname;
        $data['birthdate'] = $request->bday;
        $data['name'] = $request->fname.' '.$request->lname;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        DB::table('users')->insert($data);

        return $this->login($request);
    }
    
    public function updateDetails(Request $request)
    {
        User::where(['id'=>$request->id])->update([
            'firstname'=>$request->fname,
            'lastname'=>$request->lname,
            'birthdate'=>$request->bday,
            'name'=>$request->fname.' '.$request->lname,
            ]
        );
        return $request->fname;
    }
}