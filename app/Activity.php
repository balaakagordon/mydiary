<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'completed'
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
