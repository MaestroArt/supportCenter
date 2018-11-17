<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'title', 'user_id', 'msg', 'status', 'img',
    ];
    protected $table = 'feedbacks';
    
    public function dialogs()
    {
    	return $this->hasMany('App\Dialog');
    }
}
