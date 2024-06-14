@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subjects</h1>
    <ul>
        @foreach ($subjects as $subject)
            <li><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection

