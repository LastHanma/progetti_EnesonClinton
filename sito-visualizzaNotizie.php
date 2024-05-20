<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visualizza Notizie-Sito sull'Intelligenza Artificiale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="modernNormalize.css" />
    <link rel="stylesheet" href="modernNormalize.css" />
    <link rel="stylesheet" href="utilità-generali.css">
    <style>
        .titoliSezioni {
            font-size: 2.4rem;
            font-weight: bold;
        }

        .news-container {
            margin-top: 50px;
        }

        .card {
            width: 300px;
            height: 390px;
            margin-bottom: 20px;
        }

        /* Aggiungi queste regole per rendere le immagini più piccole */
        .card-img-top {
            max-width: 300px;
            /* Larghezza massima dell'immagine */
            height: 200px;
            /* Altezza fissa per tutte le immagini */

        }

        .card-body {

            /* Larghezza massima del corpo della card */
            overflow: hidden;
            /* Nascondi il contenuto extra */
            text-overflow: ellipsis;
            /* Aggiungi puntini di sospensione se il contenuto è troppo lungo */
        }

        .card-body.scrollable {
            overflow-y: auto;
        }

        .remove-news {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
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
                        <a class="nav-link" href="#storia">Storia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#notizie">Notizie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pro-contro">Pro e Contro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contatti">Contatti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account-UtenteAdmin.php">Account</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-4">
        <h2 class="titoliSezioni">Notizie Inviate:</h2>
        <div id="news-lista" class="row">
            <!-- Qui verranno visualizzate le notizie in tempo reale tramite JavaScript -->
        </div>
    </div>
    <!-- Modal per confermare l'eliminazione della notizia -->
    <div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNewsModalLabel">Conferma eliminazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare questa notizia?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Elimina</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", async function() {
        try {
            const [newsList, userList] = await Promise.all([fetchNews(), fetchUsers()]);
            console.log(userList);
            visualizzaNotizie(newsList, userList);
        } catch (error) {
            console.error("Si è verificato un errore durante il recupero delle notizie:", error);
            alert("Si è verificato un errore durante il recupero delle notizie.");
        }
    });

    // Funzione per recuperare le notizie
    async function fetchNews() {
        const response = await fetch("data.json");
        if (!response.ok) {
            throw new Error("Errore nel recupero delle notizie.");
        }
        return await response.json();
    }

    // Funzione per recuperare gli utenti
    async function fetchUsers() {
        const response = await fetch("utenti.json");
        if (!response.ok) {
            throw new Error("Errore nel recupero degli utenti.");
        }
        rispostaJSON = await response.json();
        console.log(rispostaJSON);
        return await rispostaJSON;
    }

    // Funzione per visualizzare le notizie inviate
    function visualizzaNotizie(newsList, userList) {
        const newsListElement = document.getElementById("news-lista");

        newsList.forEach(news => {
            const {
                id_notizia,
                image_url,
                titolo,
                descrizione,
                link,
                id_utente // Aggiungi id_utente
            } = news;

            // Trova l'utente corrispondente nell'array degli utenti
            const user = userList.find(user => Number(user.id_utente) === Number(id_utente));

            if (!user) {
                console.log(`Utente non trovato per id_utente: ${id_utente}`);
                return; // Salta questa notizia se l'utente non è trovato
            }

            const username = user.username;

            const articleElement = document.createElement("div");
            articleElement.setAttribute("id", "news-" + id_notizia);
            articleElement.classList.add("col-md-4", "mb-4");
            articleElement.innerHTML = `
            <div class="card">
                <img src="${image_url}" class="card-img-top" alt="...">
                <div class="card-body${descrizione.length > 150 ? ' scrollable' : ''}">
                    <h5 class="card-title">${titolo}</h5>
                    <p class="card-text">${descrizione}</p>
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <a href="${link}" class="btn btn-primary">Leggi di più</a>
                        <button class="btn btn-danger delete-btn" data-id="${id_notizia}" data-toggle="modal" data-target="#deleteNewsModal">Elimina Notizia</button>
                    </div>
                    <div class="mt-2">
                        <p class="text-primary">Inviata da: ${username}</p> <!-- Visualizza lo username -->
                    </div>
                </div>
            </div>
        `;
            newsListElement.appendChild(articleElement);
        });
    }

    // Evento click sul pulsante "Elimina Notizia"
    document.addEventListener("click", async function(event) {
        if (event.target.classList.contains("delete-btn")) {
            const newsId = event.target.dataset.id;
            const newsElement = document.getElementById(`news-${newsId}`);
            if (newsElement) {
                // Mostra il modal
                $('#deleteNewsModal').modal('show');

                // Gestisci il click sul pulsante "Elimina" all'interno del modal
                document.getElementById("confirmDeleteBtn").addEventListener("click", async function() {
                    try {
                        // Invia una richiesta al server per eliminare la notizia
                        const response = await fetch(`/delete-news.php?newsId=${newsId}`, {
                            method: 'DELETE'
                        });
                        if (response.ok) {
                            newsElement.classList.add("remove-news");
                            setTimeout(() => {
                                newsElement.remove(); // Rimuovi l'elemento dalla lista delle notizie
                            }, 300); // Ritardiamo la rimozione di 0.5 secondi per far vedere l'animazione

                            // Nascondi il modal dopo aver completato l'eliminazione
                            $('#deleteNewsModal').modal('hide');
                        } else {
                            throw new Error("Errore durante l'eliminazione della notizia.");
                        }
                    } catch (error) {
                        console.error("Si è verificato un errore durante l'eliminazione della notizia:", error);
                        alert("Si è verificato un errore durante l'eliminazione della notizia.");
                    }
                });
            }
        }
    });

    // ricarica della pagina dopo un certo intervallo di tempo (in queesto caso di 3 secondi)
    setTimeout(function() {
        location.reload();
    }, 30000); // Tempo in millisecondi (3000 millisecondi = 3 secondi)
</script>

</html>