<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include any CSS framework or your custom styles -->
</head>

<body>
    <div class="login-section">
        <div class="materialContainer">
            <div class="box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-title">
                        <h2>Login</h2>
                    </div>
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="input">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="button login">
                        <button type="submit">
                            <span>Log In</span>
                        </button>
                    </div>

                    <p>Not a member? <a href="{{ route('register') }}">Sign up now</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
