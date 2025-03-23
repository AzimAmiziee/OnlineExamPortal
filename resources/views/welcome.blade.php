<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Online Exam Portal</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body class="welcome-page">
    <header class="header">
        <h1 class="portal-title">🎓 Online Exam Portal</h1>
    </header>

    <main class="main-content">
        <p class="intro-text">Welcome to the Online Exam Portal. Please choose your role to continue:</p>

        <div class="role-buttons">
            <a href="{{ route('login', ['role' => 'student']) }}" class="btn student-btn">I'm a Student</a>
            <a href="{{ route('login', ['role' => 'lecturer']) }}" class="btn lecturer-btn">I'm a Lecturer</a>
        </div>

        @if (Route::has('register'))
            <p class="register-link">
                Don't have an account?
                <a href="{{ route('register') }}">Register here</a>
            </p>
        @endif
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Online Exam Portal. All rights reserved.</p>
    </footer>
</body>

</html>