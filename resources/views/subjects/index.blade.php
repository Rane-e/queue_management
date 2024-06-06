<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Subjects</h1>
    <ul>
        @foreach ($subjects as $subject)
            <li><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></li>
        @endforeach
    </ul>
</div>
</body>
</html>
