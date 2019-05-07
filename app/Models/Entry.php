<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class Entry extends Model
{
    protected $table = 'entries';

    protected $fillable = [
        'title', 'author', 'body'
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
