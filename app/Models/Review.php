<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user(){
        return $this->belongsTo(user::class);
    }
    
    public function book(){
        return $this->belongsTo(Book::class);
    }

}
