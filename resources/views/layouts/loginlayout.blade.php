<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .register-form {
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

        .form-group {
            margin-bottom: 1.5rem;
            /* Add margin bottom for spacing */
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
    @yield('content');

    <!-- Fixed Footer -->
    <footer class="bg-dark text-white text-center p-3 fixed-bottom">
        <p>&copy; {{ date('Y') }} Student Performance Analyzer. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            @if(session('message'))
                // Hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    $("#successMessage").fadeOut('slow');
                }, 5000);
            @endif
        });
    </script>
</body>

</html>