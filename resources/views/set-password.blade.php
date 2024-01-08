<!DOCTYPE html>
<html>
<head>
    <title>Wachtwoord instellen</title>
</head>
<body>
    <h1>Wachtwoord instellen</h1>

    <form method="POST" action="/set-password">
        @csrf

        <input type="hidden" name="verification_code" value="{{ $user->verification_code }}">

        <label for="password">Wachtwoord:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="password_confirmation">Herhaal wachtwoord:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation"><br><br>

        <button type="submit">Wachtwoord instellen</button>
    </form>
</body>
</html>
