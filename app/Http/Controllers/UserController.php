<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Question;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;





class UserController extends Controller
{

    /**
     * @param Request $request
     * @return object
     */
    public function add(Request $request)
    {
        $this->validate($request, User::$rules);

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

    public function getAll()
    {
        $user = JWTAuth::parseToken()->toUser();
        if (Gate::allows('view-allUsers', $user))
        {
            $users = User::get();
            return $users;
        }
        else
        {
            $response = response()->json(
                [
                    'response' => [
                        'message' => 'You do not have access to this route'
                    ]
                ], 401
            );
            return $response;
        }

    }

    public function askQuestion(Request $request, $userId)
    {
        $this->validate($request, Question::$rules);

        $question = new Question();
        $question->question =  $request->question;
        $question->user_id = $userId;

        if($question->save())
        {
            $response =response()->json(
                [
                    'response' => [
                        'created' => true,
                        'questionId' => $question->id,
                        'question' =>  $request->question,
                    ]
                ], 201
            );
        }
        return $response;

    }
}