<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
        'msg', 'feedback_id', 'user_id'
    ];
    protected $table = 'dialogs';
}
