<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <!-- Resources -->
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>


</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img src="/img/logo.png" alt="RW Events">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Eventos</a>
                    </li>

                    @auth()
                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Evento</a>
                    </li>

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">Meus Eventos</a>
                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit()">Sair</a>

                        </form>

                    </li>



                    @endauth

                    @guest()

                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>

                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>
                    @endguest

                </ul>
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <div class="row">
            @if(session('msg'))
            <p id="session-message-success">{{ session('msg') }}</p>
            @elseif(session('msg-error'))
            <p id="session-message-error">{{ session('msg-error') }}</p>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <p>RW Eventos &copy; 2022</p>
    </footer>


    <!-- icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
