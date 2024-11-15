<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'question',
        'content',
        'canonical',
        'external_id',
    ];
}
