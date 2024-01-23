<!DOCTYPE html>
<html>

<head>
    <title>Registratie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <h1>Registratie</h1>

        @if(session('success'))
        <p>{{ session('success') }}</p>
        @endif

        <form class="form" method="POST" action="/register">
            @csrf

            <label for="name">Naam:</label><br>
            <input class="input-field" type="text" id="name" name="name"><br>
            <label for="email">E-mail:</label><br>
            <input class="input-field" type="email" id="email" name="email"><br><br>

            <button class="submit-button" type="submit">Registreer</button>
            @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
            @endif
        </form>
    </div>
</body>

</html>