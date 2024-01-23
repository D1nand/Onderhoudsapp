<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <h1>Login</h1>

        <form method="POST" action="{{ route('login.submit') }}" class="form">
            @csrf

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-field">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="input-field">

            @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
            @endif

            <button type="submit" class="submit-button">Inloggen</button>
        </form>
        <p>Nog geen account? <a href="/register">Registreer hier</a></p>
    </div>
</body>

</html>