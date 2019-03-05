<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\User;
use Validator;

class AuthController extends Controller
{
    
    protected $request;

    protected $jwt;

    public function __construct(JWTAuth $jwt, Request $request){
    	$this->request = $request;
    	$this->jwt     = $jwt;
    }

    public function authenticate(){
    	try{
    		$data = $this->request->all();

	    	$rules = [
	    		'email'		=> 'required|string|email',
	    		'password'  => 'required|string'
	    	];

	    	$validator = Validator::make($data, $rules);
	    	if($validator->fails()){
	    		return response()->json([
	    			'status'	 => false,
	    			'validators' => true,
	    			'message'	 => $validator->errors()
	    		]);
	    	}

	    	$email    = $data['email'];
	    	$password = $data['password'];

	    	if($user = User::where('email', $email)->first()){
	    		if(Hash::check($password, $user->password)){
	    			$credentials = $this->request->only(['email', 'password']);
	    			if(!$token = $this->jwt->attempt($credentials)){
	    				return response()->json([
	    					'status' => false,
	    					'message' => 'Unauthorization'
	    				], 500);
	    			}

	    			return response()->json([
	    				'status'	=> true,
	    				'message'   => 'Logado com sucesso',
	    				'user'		=> $user,
	    				'token'		=> $token
	    			]);
	    		}else{
	    			return response()->json([
	    				'status'	 => false,
	    				'message'	 => 'Senha incorreta'
	    			]);
	    		}
	    	}else{
	    		return response()->json([
	    			'status'	 => false,
	    			'message'	 => 'E-mail incorreta'
	    		]);
	    	}

    	}catch(\Exception $e){
    		return response()->json([
    			'status'	=> false,
    			'message'	=> $e->getMessage() . ' in line => ' . $e->getLine()
    		], 500);
    	}
    }
}
