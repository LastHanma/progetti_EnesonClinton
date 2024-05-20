<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contatti-DiscoverAI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="utilità-generali.css" />
    <style>
        /* Stili personalizzati */
        .titoliSezioni {
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif;
            /* Usa un font simile a quello di DiscoverAI */
            font-size: 2.5rem;
            /* Aumenta la dimensione del testo */
            font-weight: bold;
            /* Rendi il testo in grassetto */
            color: #2c3e50;
            /* Usa un colore simile a quello di DiscoverAI */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="datelefono.php"><span class="logo">discover<span class="logoAi">AI</span></span></a>
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
                        <a class="nav-link" href="account-Utente.php">Account</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section id="contatti" class="mt-5">
        <div class="container">
            <h2 class="titoliSezioni text-center mb-4">Contatti</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Informazioni di contatto
                            </h5>
                            <p class="card-text">
                                Puoi contattarci tramite email o telefono.
                                Siamo disponibili per rispondere a tutte le
                                tue domande sull'Intelligenza Artificiale.
                            </p>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Email:</strong>
                                    discoverAi5DI@gmail.com
                                </li>
                                <li>
                                    <strong>Telefono:</strong> 0672462242
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Invia un messaggio</h5>
                            <form action="testInviomail.php" method="post">
                                <div class="form-group">
                                    <label for="emailInput">Indirizzo Email</label>
                                    <input type="email" class="form-control" id="emailInput" name="email" required />
                                </div>
                                <div class="form-group">
                                    <label for="messaggioInput">Messaggio</label>
                                    <textarea class="form-control" id="messaggioInput" name="messaggio" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Invia
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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