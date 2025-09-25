<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Ro‘yxatdan o‘tish</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Ism:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <label>Parol:</label>
        <input type="password" name="password">
        @error('password') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <label>Parolni tasdiqlash:</label>
        <input type="password" name="password_confirmation">
        <br>

        <button type="submit">Ro‘yxatdan o‘tish</button>
    </form>
</body>
</html>
