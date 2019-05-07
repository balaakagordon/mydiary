<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;

class EntryActivitiesController extends Controller
{
    public function update(Activity $activity)
    {
        $activity->update([
            'completed' => request()->has('completed')
        ]);
        
        return back();
    }
}
