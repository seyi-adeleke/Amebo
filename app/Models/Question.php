<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Question Extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question',
        'user_id'
    ];

    public static $rules = [
        "question" => 'required|string',
        "user_id" => 'numeric'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
