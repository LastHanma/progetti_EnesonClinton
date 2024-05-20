<?php
require_once "connesioneDatabase.php";
require_once "controlloSessione.php";
/*Controlla se l'utente è autenticato
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {

    header('Location: homepage-DiscoverAi.php', 0.5); // Reindirizza alla pagina homepage se l'utente non è autenticato
    exit;
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account - Sito sull'Intelligenza Artificiale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="modernNormalize.css" />
    <link rel="stylesheet" href="utilità-generali.css">
    <style>
        .account {
            border: 3px solid red;
            background-color: #f8f9fa;
            width: 100%;
            border: 3px solid red;
        }

        .account-info {
            padding: 20px;
            border-radius: 10px;
        }

        .account-info h2 {
            font-size: 2.4rem;
            font-weight: bold;
            color: #566b78;
        }

        .account-info p {
            color: #566b78;
        }

        .account-info .detail-label {
            font-weight: bold;
        }

        .input-group-text {
            background-color: transparent;
        }

        .input-group-append .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
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
                        <a class="nav-link" href="datelefono.php">Home</a>
                    </li>
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
                </ul>
            </div>
        </nav>
    </header>

    <section class="container mt-4">
        <div class="row ">
            <div class="col-lg-8">
                <div id="accountInfoContainer">
                    <h2>Informazioni Account</h2>
                    <p>Caricamento in corso...</p>
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
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    logout_btn = document.getElementById("btn-logOut");
    document.addEventListener("DOMContentLoaded", async function() {
        const accountInfoContainer = document.getElementById("accountInfoContainer");

        // Funzione per caricare i dati dell'account dal server PHP
        async function fetchAccountData() {
            try {
                console.log("Fetching account data...");
                const response = await fetch("utenti.json");
                const data = await response.json();
                console.log("Data fetched successfully:", data);
                localStorage.setItem("utente", JSON.stringify(data))
                return data;
            } catch (error) {
                console.error("Error fetching account data:", error);
                return null;
            }
        }
        // Funzione per ottenere solo i dati dell'utente corrispondente a utenteIndex
        function getUserDataById(userData, utenteIndex) {
            return userData.find(user => user.id_utente === utenteIndex);
        }

        // Funzione per visualizzare i dati dell'account nell'HTML
        function renderAccountData() {
            let loggato = true;
            const utenteIndex = <?php echo isset($_SESSION["utenteIndex"]) ? $_SESSION["utenteIndex"] : -1; ?>;
            console.log(utenteIndex)
            console.log("sessione id utente:", utenteIndex);
            const userData = JSON.parse(localStorage.getItem("utenti"));
            console.log("Rendering account data:", userData);

            if (utenteIndex !== -1) {
                const user = userData //getUserDataById(userData, utenteIndex);
                if (user) {
                    accountInfoContainer.innerHTML = `
            <div class="account-info mb-4" id="account-info">
                <h2>Informazioni Account</h2>
                <div class="row" id="info-visible">
                    <div class="col-sm-6">
                        <p><span class="detail-label">Nome:</span> ${user.nome}</p>
                        <p><span class="detail-label">Cognome:</span> ${user.cognome}</p>
                        <p><span class="detail-label">Username:</span> ${user.username}</p>
                    </div>
                    <div class="col-sm-6 ao">
                        <p><span class="detail-label">Email:</span> ${user.email}</p>
                        <div class="input-group">
                            <div class="d-flex align-items-center"> 
                                <p class="detail-label mr-2 mb-0">Password:</p> 
                            </div>
                            <input type="password" class="form-control" id="password" value="${user.password}" readonly >
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="password-toggle"><i class="fas fa-eye" id="password-icon"></i></button>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-sm-6 mt-3">
                        <button class="btn btn-primary" id="btn-logOut">Logout</button>
                        <button id="editButton" class="btn btn-primary">Modifica</button>
                    </div>
                </div>
                <form id="updateAccountForm" action="aggiornaInfoUtente.php"  method="post" style="display: none;">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="${user.nome}">
        </div>
        <div class="form-group">
            <label for="cognome">Cognome:</label>
            <input type="text" class="form-control" id="cognome" name="cognome" value="${user.cognome}">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="${user.username}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="${user.email}">
        </div>
        <div class="form-group">
            <label for="newPassword">Nuova Password:</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword">
        </div>
        <button type="submit" class="btn btn-primary">Aggiorna</button>
        <button type="button" id="cancelButton" class="btn btn-secondary">Annulla</button>
    </form>
            </div>`;
                    const logoutBtn = document.getElementById("btn-logOut");
                    const editButton = document.getElementById("editButton");
                    const cancelButton = document.getElementById("cancelButton");
                    const updateAccountForm = document.getElementById("updateAccountForm");
                    editButton.addEventListener("click", function() {
                        // Nascondi le informazioni dell'account e mostra il modulo di aggiornamento
                        document.getElementById("info-visible").style.display = "none";
                        document.getElementById("accountInfoContainer").style.display = "block";

                        updateAccountForm.style.display = "block";
                    });

                    cancelButton.addEventListener("click", function() {
                        // Nascondi il modulo di aggiornamento e mostra le informazioni dell'account
                        setTimeout(function() {
                            window.location.reload();
                            updateAccountForm.style.display = "none";
                            document.getElementById("accountInfoContainer").style.display = "block";

                        }, 500);


                    });

                    updateAccountForm.addEventListener("submit", function(event) {
                        //event.preventDefault(); // Impedisci il comportamento predefinito del modulo di aggiornamento

                        // Recupera i valori dei campi del modulo
                        const nome = document.getElementById("nome").value;
                        const cognome = document.getElementById("cognome").value;
                        const username = document.getElementById("username").value;
                        const email = document.getElementById("email").value;
                        const newPassword = document.getElementById("newPassword").value;

                        // Invia i dati al server per l'aggiornamento dell'account (implementa questa parte nel tuo backend)
                        // Dopo aver completato con successo l'aggiornamento, puoi nascondere il modulo di aggiornamento e mostrare le informazioni dell'account aggiornate
                        updateAccountForm.style.display = "none";
                        document.getElementById("accountInfoContainer").style.display = "block";
                    });
                    logoutBtn.addEventListener("click", () => {
                        setTimeout(function() {

                            localStorage.removeItem('utenti');
                            window.location.reload();
                            window.location.href = "login-DiscoverAi.php";

                        }, 1000);

                    });


                } else {
                    accountInfoContainer.innerHTML = "<p>Nessun dato trovato.</p>";
                }

                // Funzione per mostrare/nascondere la password
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById("password");
                    const passwordIcon = document.getElementById("password-icon");

                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        passwordIcon.classList.remove("fa-eye");
                        passwordIcon.classList.add("fa-eye-slash");
                    } else {
                        passwordInput.type = "password";
                        passwordIcon.classList.remove("fa-eye-slash");
                        passwordIcon.classList.add("fa-eye");
                    }
                }

                // Aggiungi un gestore di eventi al clic sull'icona dell'occhio
                document.getElementById("password-toggle").addEventListener("click", togglePasswordVisibility);
            }
        }




        // Carica i dati dell'account e aggiorna l'HTML
        //const accountData = await fetchAccountData();
        renderAccountData();


    });
    // Funzione per gestire il clic sulla casella di controllo per mostrare o nascondere la password
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>