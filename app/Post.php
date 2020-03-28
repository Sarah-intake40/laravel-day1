<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //---------------wanted to fill fields 
    protected $fillable =['title','description','user_id'];

    //---------------relation with user table
      public function user(){
          return $this->belongsTo('App\User');
      }
}
