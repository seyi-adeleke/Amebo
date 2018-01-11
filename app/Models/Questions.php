<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Questions Extends Model
{
    protected $table = 'questions';

    protected $fillable = ['question'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
