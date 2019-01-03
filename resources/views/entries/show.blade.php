@extends('layout')



@section('content')
    <h1 class="title">View Entry</h1>

    
    <div class="title">
        {{$entry->title}} - {{$entry->user_id}}
    </div>
    <div class="content">
        {{$entry->data}}
    </div>
    <p>
        <a href="/entries/{{$entry->id}}/edit">
            edit
        </a>
    </p>
    <br/>
    @if ($entry->activities->count())
    <div>
        My activities include:
        @foreach ($entry->activities as $activity)
            <div>
                <form method="POST" action="/activities/{{$activity->id}}">   
                    @method('PATCH')
                    @csrf
                    <label class="checkbox {{ $activity->completed ? 'is-complete' : '' }}" for="completed">
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $activity->completed ? 'checked' : '' }}>
                        {{$activity->description}}
                    </label>
                </form>
            </div>
        @endforeach
    </div>
    @endif
    <br/>
    <p>
        <a href="/entries">
            home
        </a>
    </p>

@endsection
