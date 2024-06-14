<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>QUEUE</title>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
</head>
<body>
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

    <div>
        @yield('content')
    </div>
</body>
</html>