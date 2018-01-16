<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Question Extends Model
{
    protected $table = 'questions';

    protected $fillable = ['question'];

    public static $rules = [
        "question" => "string",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
