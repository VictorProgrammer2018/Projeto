<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\City;
use Validator;

class ClientController extends Controller
{
    

    /**
     * Instance Request
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create new instance controller
     * @param  \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
    	$this->request = $request;
    }

    /**
     * Authenticate user
     * @return \Illuminate\Http\Response
     */
    public function create(){
    	$data = $this->request->all();

    	$rules = [
    		'username'	=> 'required|string|min:6',
    		'email'		=> 'required|string|email|unique:users',
    		'password'  => 'required|string|min:6|confirmed'
    	];

    	$validator 		= Validator::make($data, $rules);
    	if($validator->fails()){
    		return response()->json([
    			'status'   	 => false,
    			'validators' => true,
    			'message' 	 => $validator->errors()
    		]);
    	}
        $email = (filter_var($data['email']) ? $data['email'] : '');
    	$user 			  = new User;
    	$user->username   = $data['username'];
    	$user->email      = $email;
    	$user->password   = Hash::make($data['password']);
    	$save 			  = $user->save();
    	if($save){
    		return response()->json([
    			'status'	=> true,
    			'message'	=> 'Registrado com sucesso',
    			'user'		=> $user
    		]);
    	}else{
    		return response()->json([
    			'status'	=> false,
    			'message'	=> 'Ocorreu um erro ao se registrar'
    		]);
    	}
    }


    public function update($id){
        try{
            $data = $this->request->all();
            $user = User::findOrFail($id);
            $rules = [
                'username'  => 'required|string|min:6',
                'email'     => ['required', 'string', 'email',
                Rule::unique('users', 'email')->ignore($user->id, 'id')],
            ];

            $validator      = Validator::make($data, $rules);
            if($validator->fails()){
                return response()->json([
                    'status'     => false,
                    'validators' => true,
                    'message'    => $validator->errors()
                ]);
            }
            $email = (filter_var($data['email']) ? $data['email'] : '');
            $user->username   = $data['username'];
            $user->email      = $email;
            $user->password   = $user->password;
            $save             = $user->save();
            if($save){
                return response()->json([
                    'status'    => true,
                    'message'   => 'Perfil atualizado com sucesso',
                    'user'      => $user
                ]);
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => 'Ocorreu um erro ao atualizar o perfil'
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'statua'    => false,
                'message'   => $e->getMessage() . ' in line => ' . $e->getLine()
            ], 500);
        }
    }
}
