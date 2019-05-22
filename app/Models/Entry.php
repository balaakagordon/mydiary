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

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}
