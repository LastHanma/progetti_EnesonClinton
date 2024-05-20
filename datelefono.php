<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Sito sull'Intelligenza Artificiale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="modernNormalize.css">
    <link rel="stylesheet" href="utilità-generali.css">

    <style>
        /* Aggiungi qui eventuali stili personalizzati */
        .contenitore {
            /* border: 3px solid black; */
        }

        b a {
            text-decoration: none;
            color: black;
        }

        b a:hover {
            text-decoration: underline;
        }

        .contenitore .paragrafo {
            /* max-width: 60ch; */
        }

        .titoliSezioni {
            font-size: 2.4rem;
            font-weight: bold;
        }

        .logo {
            font-size: 3rem;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-weight: bold;
        }

        .logoAi {
            color: #566b78;
        }



        body {
            margin: 0;
            display: flex;
            /* This makes the body a flex container */
            flex-direction: column;
            /* Sets the flex container to have a vertical column layout. */
            min-height: 100vh;
            /* Ensures that the body takes up at least the full height of the viewport. */
            box-sizing: inherit;
        }

        @media (min-width: 320px) {
            .logo {
                font-size: 1.5rem;
            }
        }

        @media (min-width: 400px) {
            .logo {
                font-size: 2rem;
            }
        }

        @media (min-width: 768px) {
            .logo {
                font-size: 3rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><span class="logo">discover<span class="logoAi">AI</span></span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="storiaAI.php">Storia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ultimeNotizie.php">Notizie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pro&contro.html">Pro e Contro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newsUtente.php">News Utente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contatti.php">Contatti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account-Utente.php">Account</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h1 class="informativa_home">Benvenuti su DiscoverAI,sito sull'Intelligenza Artificiale</h1>
        <p>Una risorsa informativa sull'Intelligenza Artificiale</p>
    </div>

    <footer class="text-center" style="background-color: #343a40; color: #ffffff; padding: 10px 0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 style="color: white; font-weight: bold">
                        DiscoverAI
                    </h5>
                    <ul class="footer-links" style="list-style: none; padding: 0">
                        <li>
                            <a href="datelefono.php" style="color: #ffffff">Home</a>
                        </li>
                        <li>
                            <a href="storiaAI.php" style="color: #ffffff">Storia</a>
                        </li>
                        <li>
                            <a href="ultimeNotizie.php" style="color: #ffffff">Notizie</a>
                        </li>
                        <li>
                            <a href="newsUtente.php" style="color: #ffffff">News Utente</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 style="color: white; font-weight: bold">Risorse</h5>
                    <ul class="footer-links" style="list-style: none; padding: 0">
                        <li>
                            <a href="contatti.php" style="color: #ffffff">Contatti</a>
                        </li>
                        <li>
                            <a href="account-Utente.php" style="color: #ffffff">Account</a>
                        </li>
                        <li>
                            <a href="faq.php" style="color: #ffffff">FAQ</a>
                        </li>
                        <li>
                            <a href="privacy.php" style="color: #ffffff">Privacy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 style="color: white; font-weight: bold">
                        Contattaci
                    </h5>
                    <p style="color: #ffffff">Email: discoverAi5DI@gmail.com</p>
                    <p style="color: #ffffff">Telefono: 0672462242</p>
                    <p style="color: #ffffff">cellulare: +39 3756851045</p>
                    <div class="social-icons w-50 mx-auto d-flex justify-content-between">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <p class="mt-2 mb-0" style="color: white">
                &copy; 2024 DiscoverAI. Tutti i diritti riservati.
            </p>
        </div>

    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>