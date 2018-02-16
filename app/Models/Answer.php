<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Answer Extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'question_id'
    ];

    public static $rules = [
        "answer" => 'required|string',
        "question_id" => 'numeric'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
