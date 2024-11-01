<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .login-form {
            max-width: 400px;
            /* Set a maximum width for the form */
            margin: auto;
            /* Center the form */
            padding: 20px;
            /* Add padding */
            border: 1px solid #ced4da;
            /* Add a border */
            border-radius: 8px;
            /* Round the corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
            background-color: #fff;
            /* White background */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header -->
    <header class="bg-primary text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4">Student Performance Analyzer</h1>

            <!-- Authentication Button -->
            <nav>
                @auth
                <!-- Show Logout button if user is logged in -->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-white">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <!-- Show Login button if user is not logged in -->
                <a href="{{ route('login') }}" class="text-white">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="container mt-5 flex-grow-1">
        <div class="login-form">
            <h2 class="text-center">Login</h2>

            @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                {{-- <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <!-- Additional Links -->
            <div class="mt-3 text-center">
                <a href="#" class="text-muted">Forgot Password?</a>
                <br>
                <a href="{{ route('register') }}" class="btn btn-link">Sign Up</a>
            </div>
        </div>
    </div>

    <!-- Fixed Footer -->
    <footer class="bg-dark text-white text-center p-3 fixed-bottom">
        <p>&copy; {{ date('Y') }} Student Performance Analyzer. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            @if(session('error'))
                $(".alert-danger").show().text('{{ session('error') }}');
            @endif
        });
    </script>
</body>

</html>