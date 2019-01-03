<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>New Entry</h1>

        <form method="POST" action="/entries">

            {{ csrf_field() }}

            <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : ''}}" name="title" placeholder="Entry Title" value="{{old('title')}}" required>
            </div>
            <div>
                <input type="number" min="1" name="user_id" placeholder="1" default="1" value="{{old('user_id')}}" required>
            </div>
            <div class="control">
                <textarea name="data" placeholder="Entry Data" required>{{old('data')}}</textarea>
            </div>
            <div class="control">
                <button type="submit">Create Entry</button>
            </div>
            @if ($errors->any())
                <div class="notification is-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                </div>
            @endif
        </form>
    </body>
</html>