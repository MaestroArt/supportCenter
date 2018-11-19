<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVars extends Model
{
    protected $fillable = [
        'name', 'user_id', 'value'
    ];
    protected $table = 'user_vars';
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    static public function setValue($name,$value,$user_id)
    {
    	$vars=User::find($user_id)->vars;
        $var=$vars->where('name',$name)->first();
        if(null == $var) {
            self::create([
                'user_id' => $user_id,
                'name' => $name,
                'value' => $value,
            ]);
        }else {
            $var->value=$value;
            $var->save();
        }
    }
    static public function getValue($name,$user_id)
    {
    	$vars=User::find($user_id)->vars;
        $var=$vars->where('name',$name)->first();
        if(null == $var)
        	return null;
        return $var->value;
    }
}
