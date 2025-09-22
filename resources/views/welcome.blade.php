<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | My Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <span class="brand-text font-weight-bold">My Project</span>
                </a>

                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="display:inline; padding:0;">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container text-center mt-5">
                    <h1 class="display-4">Welcome to My Project</h1>
                    <p class="lead">This is the simple landing page.</p>

                    <div class="mt-4">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
