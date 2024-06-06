<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Edit Queue for {{ $subject->name }}</h1>
    <form action="{{ route('admin.queue.update') }}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
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
                        <td>
                            <input type="number" name="queues[{{ $queue->id }}][position]" value="{{ $queue->position }}" class="form-control">
                            <input type="hidden" name="queues[{{ $queue->id }}][id]" value="{{ $queue->id }}">
                        </td>
                        <td>{{ $queue->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Queue</button>
    </form>
</div>
</body>
</html>