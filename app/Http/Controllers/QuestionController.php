<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;

use Illuminate\Http\Request;




class QuestionController extends Controller
{
    public function answerQuestion(Request $request, $userId, $questionId)
    {
        $question = Question::find($questionId);

        if($question->answer)
        {
            return response()->json(
                ['response' => [
                    'message'=> 'You have already answered this question'
                ]], 400
            );
        };

        $this->validate($request, Answer::$rules);

        $answer = new Answer();
        $answer->answer =  $request->answer;
        $answer->question_id = $questionId;

        if($answer->save())
        {

            $response = response()->json(
                [
                    'response' => [
                        'created' => true,
                        'answerId' => $answer->id,
                        'answer' => $answer->answer,
                    ]
                ], 201
            );
        }
        return $response;
    }
}