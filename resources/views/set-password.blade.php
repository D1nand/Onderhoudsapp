<!DOCTYPE html>
<html>

<head>
    <title>Wachtwoord instellen</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .container {
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .form {
            display: inline-block;
            text-align: left;
        }

        .input-field {
            margin-bottom: 10px;
        }

        .message {
            font-size: 0.8em;
            color: #666;
        }

        .error {
            color: red;
        }

        .submit-button {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Wachtwoord instellen</h1><br>

        <form class="form" method="POST" action="/set-password" onsubmit="return validatePassword()">
            @csrf

            <input type="hidden" name="passwordCode" value="{{ $user->passwordCode }}">

            <label for="password">Wachtwoord:</label><br>
            <input class="input-field" type="password" id="password" name="password" required>
            <div id="passwordMessages" class="message"></div><br>

            <label for="password_confirmation">Herhaal wachtwoord:</label><br>
            <input class="input-field" type="password" id="password_confirmation" name="password_confirmation" required>
            <div id="confirmPasswordMessage" class="message"></div><br>

            <button class="submit-button" type="submit" id="submitButton" disabled>Wachtwoord aanmaken</button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordMessages = document.getElementById('passwordMessages');
        const confirmPasswordMessage = document.getElementById('confirmPasswordMessage');
        const submitButton = document.getElementById('submitButton');

        function validatePassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            let message = '';

            if (!/[A-Z]/.test(password)) {
                message = 'Wachtwoord moet minimaal 1 hoofdletter hebben.';
                submitButton.disabled = true;
            } else if (password.length < 8) {
                message = 'Wachtwoord moet minimaal 8 karakters lang zijn.';
                submitButton.disabled = true;
            } else if (!/\d{2}/.test(password)) {
                message = 'Wachtwoord moet minimaal 2 cijfers hebben.';
                submitButton.disabled = true;
            } else if (!/[!@#$%^&*]/.test(password)) {
                message = 'Wachtwoord moet minimaal 1 speciaal teken hebben zoals: !@#$%^&*';
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }

            passwordMessages.textContent = message;
            passwordMessages.classList.toggle('error', message !== '');

            if (password !== confirmPassword) {
                confirmPasswordMessage.textContent = 'Wachtwoorden komen niet overeen, probeer opnieuw.';
                confirmPasswordMessage.classList.add('error'); // Add error class for red text
                submitButton.disabled = true;
            } else {
                confirmPasswordMessage.textContent = '';
                confirmPasswordMessage.classList.remove('error'); // Remove error class
                submitButton.disabled = false;
            }

            return message === '' && password === confirmPassword;
        }

        confirmPasswordInput.addEventListener('input', validatePassword);
    </script>
</body>

</html>