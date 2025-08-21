<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">
                <a href="/todo">Simple To Do List</a></div>
            
            <div class="navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item">Logout</div></li>
                                </form>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        
        </div>
    </nav>
    
    <div class="container mt-4">
        @yield('content')
        
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>