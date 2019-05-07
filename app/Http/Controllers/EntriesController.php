<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class EntriesController extends Controller
{
    public function index()
    {
        $entries = Entry::all();
        return view('entries.index', compact('entries'));
    }

    public function create()
    {
        return view('entries.create');
    }

    public function edit(Entry $entry)
    {
        return view('entries.edit', compact('entry'));
    }

    public function show(Entry $entry)
    {
        return view('entries.show', compact('entry'));
    }

    public function destroy(Entry $entry)
    {
        $entry->delete();
        return redirect('/entries');
    }
    
    // public function destroy($id)
    // {
    //     $entry = Entry::findOrFail($id)->delete();
    //     return redirect('/entries');  
    // }
    
    public function update(Entry $entry)
    {;    
        $entry->title = request('title');
        $entry->user_id = request('user_id');
        $entry->data = request('data');
        $entry->save(); 
        return redirect('/entries');
    }
    
    public function store(Request $request) 
    {
        var_dump($request);
        echo('stop');
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'user_id' => 'required',
            'data' => ['required', 'min:3']
        ]);
        Entry::create($attributes);
        return redirect('/entries');
    }
    
    // public function store() 
    // {
    //     $entry = new Entry();
    //     $entry->title = request('title');
    //     $entry->user_id = request('user_id');
    //     $entry->data = request('data');
    //     $entry->save(); 
    //     return redirect('/entries');
    // }
    
}
