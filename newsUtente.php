<!DOCTYPE html>
<html lang="en">
<?php
// Avvia la sessione
require_once 'controlloSessione.php';
/*Controlla se l'utente è autenticato
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {

    header('Location: homepage-DiscoverAi.php', 0.5); // Reindirizza alla pagina homepage se l'utente non è autenticato
    exit;
}*/
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Sito sull'Intelligenza Artificiale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="modernNormalize.css" />

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

        .btn_clr {
            background-color: #566b78;
            margin-left: 0;
        }

        .remove-news {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .container-btn {
            gap: 1.5rem;
            padding-left: 0;
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
        <section id="news_utente">
            <h2 class="titoliSezioni">News Utente</h2>
            <!-- Aggiungi qui una raccolta di risorse utili -->
            <h2 class="titoliSezioni">Inserisci una Notizia</h2>
            <form id="news-form" action="bho.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="image-url">Carica un'immagine:</label>
                    <input type="file" class="form-control" name="image" id="image-url" accept="image/*" />
                </div>
                <div class="form-group">
                    <label for="news-title">Titolo:</label>
                    <input type="text" class="form-control" name="title" id="news-title" />
                </div>
                <div class="form-group">
                    <label for="news-description">Descrizione:</label>
                    <textarea class="form-control" name="description" id="news-description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="news-link">Link:</label>
                    <input type="url" class="form-control" name="link" id="news-link" />
                </div>
                <div class="container-btn mx-0 container mt-4 d-flex  align-items-center ">
                    <button type="button" id="inserisciBTN" class="btn_clr btn btn-primary">
                        Inserisci Notizia
                    </button>
                    <button type="button" id="eliminaBTN" class="btn btn-primary">
                        Elimina Notizie
                    </button>
                </div>
            </form>

            <div id="news-lista" class="row">
                <!-- Qui verranno visualizzate le notizie in tempo reale tramite JavaScript -->
            </div>
        </section>
    </div>
    <!-- Modal di conferma -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Conferma Invio Notizia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler inviare questa notizia all'amministratore?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="button" id="sendConfirmation" class="btn btn-primary">Invia</button>
                </div>
            </div>
        </div>
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
<script>
    // Funzione per gestire l'invio del modulo di inserimento della notizia
    inserisciBTN = document.getElementById("inserisciBTN");
    eliminaBTN = document.getElementById("eliminaBTN");
    inviaNotizia = document.getElementById("inviaNotizia");

    inserisciBTN.addEventListener("click", function(event) {
        event.preventDefault(); // Impedisci il comportamento predefinito del modulo

        // Ottieni i valori inseriti dall'utente
        const imageUrl = document.getElementById("image-url").files[0]; // Ottieni il file immagine
        const newsTitle = document.getElementById("news-title").value;
        const newsDescription =
            document.getElementById("news-description").value;
        const newsLink = document.getElementById("news-link").value;

        // Creazione di un oggetto URL per l'immagine selezionata
        const imageURLObject = URL.createObjectURL(imageUrl);

        // Aggiungi la nuova notizia alla lista
        const newsListElement = document.getElementById("news-lista");
        const articleElement = document.createElement("div");
        const utenteIndex = <?php echo isset($_SESSION["utenteIndex"]) ? $_SESSION["utenteIndex"] : -1; ?>;
        const newsId = utenteIndex !== -1 ? utenteIndex : console.log("Errore piske!");
        articleElement.setAttribute("id", "news-" + newsId); // Imposta l'ID univoco per la notizia
        articleElement.classList.add("col-md-6", "mb-4");
        articleElement.innerHTML = `
    <div class="card">
      <img src="${imageURLObject}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">${newsTitle}</h5>
        <p class="card-text">${newsDescription}</p>
        <div class="w-100 d-flex justify-content-between align-items-center">
          <a href="${newsLink}" class="btn btn-primary">Leggi di più</a>
          <button class="btn btn-danger delete-btn" data-id="${newsId}">Elimina Notizia</button> <!-- Aggiungi data-id -->
          <button " id="" class="btn btn-primary inviaNotizia">Invia Notizia</button>
        </div>
      </div>
    </div>
  `;
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("inviaNotizia")) {
                event.preventDefault(); // Impedisci il comportamento predefinito del pulsante
                $('#confirmModal').modal('show');
            }
        });

        newsListElement.appendChild(articleElement);


    });
    // Aggiungi un gestore di eventi per il clic sul pulsante "Invia" nel modal di conferma
    document.getElementById("sendConfirmation").addEventListener("click", async function() {
        // Chiudi il modal di conferma
        $('#confirmModal').modal('hide');
        document.getElementById("news-form").submit();
        // Resetta il modulo dopo l'inserimento della notizia
        document.getElementById("news-form").reset();
    });

    // Funzione per caricare le notizie dal DOM quando la pagina viene caricata
    document.addEventListener("DOMContentLoaded", function() {
        loadNewsFromDOM();
    });

    // Funzione per memorizzare le notizie dal DOM quando la pagina viene caricata
    function loadNewsFromDOM() {
        const newsListElement = document.getElementById("news-lista");
        const storedNews = newsListElement.innerHTML;
        localStorage.setItem("news", storedNews);
    }
    // Funzione per generare un ID univoco
    function generateUniqueId() {
        return "_" + Math.random().toString(36).substr(2, 9);
    }

    eliminaBTN.addEventListener("click", function() {
        const newsListElement = document.getElementById("news-lista");
        newsListElement.innerHTML = ""; // Rimuovi tutti gli elementi figlio
    });




    // Funzione per inviare la notizia all'amministratore
</script>

</html>