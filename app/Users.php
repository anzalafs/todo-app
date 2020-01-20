<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Users extends Model implements Authenticatable{

    use AuthenticableTrait;
    protected $fillable = ['f_name','l_name','email','password','mobile','gender','b_day','api_token','updated_at'];
    //.env.example
    protected $hidden = [
    'password'
    ];

    /*
    * Get Todo of User
    *
    */
    public function todo()
    {
        return $this->hasMany('App\Todo','user_id');
    }
}
