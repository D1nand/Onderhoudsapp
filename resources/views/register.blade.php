<!DOCTYPE html>
<html>
<head>
    <title>Registratie</title>
</head>
<body>
    <h1>Registratie</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="/register">
        @csrf

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <button type="submit">Registreer</button>
    </form>
</body>
</html>
