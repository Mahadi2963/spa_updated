<!-- resources/views/teacher/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            height: calc(100vh - 56px);
            position: fixed;
            padding-top: 20px;
            z-index: 1;
        }

        .sidebar a {
            display: block;
            color: #333;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        .sidebar .logout-link {
            margin-top: 20px;
            color: #dc3545;
        }

        .content {
            margin-top: 56px;
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        footer {
            background-color: #343a40;
        }

        header {
            z-index: 2;
            position: relative;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-primary text-white p-3 fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4">Student Performance Analyzer</h1>
            <nav>
                @auth
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-white">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="text-white">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <div class="sidebar">
        <br><br><br><br>
        <h4 class="text-center">Menu</h4>
        <ul class="nav flex-column ml-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('teacher.dashboard') }}">Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('teacher.viewSubjects') }}">Subjects</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('teacher.evaluation') }}">Evaluation</a>
            </li>



            <li class=" nav-item">
                <a class="nav-link" href="#">Profile Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Support and Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </li>
        </ul>
    </div>





    <!-- Main Content Area -->
    @yield('content')







    <!-- Fixed Footer -->
    <footer class="text-white text-center p-3 fixed-bottom">
        <p>&copy; {{ date('Y') }} Student Performance Analyzer. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            @if(session('message'))
                setTimeout(function() {
                    $("#successMessage").fadeOut('slow');
                }, 2000);
            @endif
        });
    </script>
</body>

</html>