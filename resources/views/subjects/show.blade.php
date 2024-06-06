<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
@if ($userName)
        <h1>Welcome, {{ $userName }}</h1>
        <form action="{{ route('logout') }}" method="post">
                                @csrf
            <button>logout</button>
        </form>
    @else
        <h1>Welcome to the Subject Queue</h1>
        <form action="{{ route('login') }}" method="get">
                                @csrf
            <button>login</button>
        </form>
        <form action="{{ route('register') }}" method="get">
        @csrf
            <button>reg</button>
        </form>
    @endif
    <h1>{{ $subject->name }}</h1>
    <h2>Queue</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Position</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queues as $queue)
                <tr>
                    <td>{{ $queue->position }}</td>
                    <td>
                        @if($queue->user_id == Auth::id())
                            <span style="font-weight: bold;">{{ $queue->user->name }}</span>
                        @else
                        {{ $queue->user->name }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (Auth::check())
        @if ($userInQueue)
            <form action="{{ route('queue.leave', $userInQueue->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Leave Queue</button>
            </form>
            <form action="{{ route('queue.skip', $subject->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-warning">Skip</button>
            </form>
            <form action="{{ route('queue.end', $subject->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Go to End</button>
            </form>
            <form action="{{ route('queue.leave', $queue->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Leave Queue</button>
            </form>
        @else
            <form action="{{ route('queue.join', $subject->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Join Queue</button>
            </form>
        @endif
    @endif
</div>
</body>
</html>