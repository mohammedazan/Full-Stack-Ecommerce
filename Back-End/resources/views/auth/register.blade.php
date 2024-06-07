<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include any CSS framework or your custom styles -->
</head>

<body>
    <div class="register-section">
        <div class="materialContainer">
            <div class="box">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="login-title">
                        <h2>Register</h2>
                    </div>
                    <div class="input">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input id="phone" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" name="phone" :value="old('phone')" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <input id="address" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" name="address" :value="old('address')" required>
            </div>



                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="input">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="input">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
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

                    <div class="button register">
                        <button type="submit">
                            <span>Register</span>
                        </button>
                    </div>

                    <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
