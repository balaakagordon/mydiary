<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'title', 'user_id', 'data'
    ];
    
    // The ones that should not be mass-filled
      
    // protected $guarded = [
    //     'title', 'user_id', 'data'
    // ];


    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}
