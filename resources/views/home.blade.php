<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Jumbotron */
        .jumbotron {
            background: linear-gradient(180deg, #1b5a90, #00d0f1);
            color: #ffffff; /* White */
        }

        /* Cards */
        .card {
            background-color: #f8f9fa; /* Light grey */
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #343a40; /* Dark grey */
        }

        .card-text {
            color: #6c757d; /* Grey */
        }

        /* Buttons */
        .btn-primary {
            background-color: #007bff; /* Blue */
            border-color: #007bff; /* Blue */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Dark blue */
            border-color: #0056b3; /* Dark blue */
        }

        /* Footer */
        .footer {
            background-color: #343a40; /* Dark grey */
            color: #ffffff; /* White */
            padding: 20px 0;
        }

        .footer .text-muted {
            color: #ffffff; /* White */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"></ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">Book Management System</h1>
              @if(Auth::guard('employe')->check())
            <a href="{{ url('find-doctor') }}" class="btn btn-primary">Find Doctor</a>
            @endif
        </div>
    </div>

    <!-- Event Content -->
    <div class="container">
        <div class="row">
            @if(Auth::guard('doctor')->check())
                <!-- If doctor is logged in -->
                <div class="col-md-12 text-center">
                    <a href="{{ url('doctor-dashboard') }}" class="btn btn-primary">Doctor Dashboard</a>
                </div>
            @elseif(Auth::guard('employe')->check())
                <!-- If employee is logged in -->
                <div class="col-md-12 text-center">
                    <a href="{{ url('app-list') }}" class="btn btn-primary">Patient Dashboard</a>
                </div>
            @else
                <!-- If no one is logged in, show patient and doctor login/register buttons -->
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Patient Login</h5>
                            <p class="card-text">Patient can login here to manage the Book.</p>
                            <a href="{{ url('userlogin') }}" class="btn btn-primary">Patient Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Patient Register</h5>
                            <p class="card-text">Patient can register here to manage the task.</p>
                            <a href="{{ url('user-register') }}" class="btn btn-primary">Patient Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Doctor Login</h5>
                            <p class="card-text">Doctor can login here to manage the Book.</p>
                            <a href="{{ url('doctorlogin') }}" class="btn btn-primary">Doctor Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Doctor Register</h5>
                            <p class="card-text">Doctor can register here to manage the task.</p>
                            <a href="{{ url('doctor-register') }}" class="btn btn-primary">Doctor Register</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">Footer</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
