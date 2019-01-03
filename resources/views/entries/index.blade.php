<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Entries</h1>

        @foreach ($entries as $entry)
            <a href="/entries/{{$entry->id}}">
                <li>{{ $entry->title }}</li>
            </a>
        @endforeach
        <p>
            <a href="/entries/create">
                new
            </a>
        </p>
    </body>
</html>