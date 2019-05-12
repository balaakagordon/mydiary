<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthClients extends Model
{
    protected $table = 'oauth_clients';

    protected $fillable = [];

    // The ones that should not be mass-filled

    protected $guarded = [
        'secret', 'redirect'
    ];


}
