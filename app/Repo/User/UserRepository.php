<?php 

namespace App\Repo\User;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\User;
use Hash;
use JWTAuth;
use Auth;
use JWTAuthException;

class UserRepository extends BaseRepository implements UserInterface{

	public function __construct(){

		$this->modelName = new User();
	}

	
	public function create($request){
		
		$requestAll = $request->all();
		$requestAll["password"] = Hash::make($request->input('password'));
		return $this->modelName->create($requestAll);
	}

	public function login($request){

		$credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
	}

	public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    public function logout(Request $request){

        JWTAuth::setToken($request->token)->invalidate();
        return response()->json(['result' => 'logout']);
    }

	
}