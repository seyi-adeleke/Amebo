<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller
{
    /**
     * @param Request $request
     * @return object
     */
    public function add(Request $request)
    {
        $response =
            $this->validate(
                $request, [
                    'firstname' => 'required|max:255',
                    'surname' => 'required|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required'
                ]
            );

        $user = new User();
        $user->firstname = $request->firstname;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 1;


        $user->save();

        if($user->save())
        {
            $response = response()->json(
                [
                    'response' => [
                        'created' => true,
                        'userId' => $user->id,
                        'message' => 'Welcome to Amebo!'
                    ]
                ], 201
            );
        }
        return $response;
    }


}