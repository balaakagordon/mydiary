@extends('layout')



@section('content')
    <h1 class="title">Edit Entry</h1>

    
<form method="POST" action="/entries/{{$entry->id}}">
    {{method_field("PATCH")}}
    {{ csrf_field() }}

    <div class="field">
        <label class="label" for="title">Title</label>
        <div class="control">
            <input type="text" name="title" placeholder="Entry Title" value="{{$entry->title}}">
        </div>
    </div>
    <div class="field">
        <label class="label" for="title">User</label>
        <div class="control">
            <input type="number" min="1" name="user_id" placeholder="1" default="1" value="{{$entry->user_id}}">
        </div>
    </div>
    <div class="field">
        <label class="label" for="title">Entry</label>
        <div class="control">
            <textarea name="data" placeholder="Entry Data">{{$entry->data}}</textarea>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit">Update Entry</button>
        </div>
    </div>
</form>
<form method="POST" action="/entries/{{$entry->id}}">
    @method("DELETE")
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit">Delete Entry</button>
        </div>
    </div>
</form>
<p>
    <a href="/entries">
        home
    </a>
</p>

@endsection
