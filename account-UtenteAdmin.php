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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account - Sito sull'Intelligenza Artificiale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
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
                        <a class="nav-link" href="#pro-contro">Pro e Contro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sito-visualizzaNotizie.php">Visualizza Notizie</a>
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
                const response = await fetch("admins.json");
                const data = await response.json();
                console.log("Data fetched successfully:", data);
                localStorage.setItem("admins", JSON.stringify(data))
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
            console.log("sessione id utente:", utenteIndex);
            const userData = JSON.parse(localStorage.getItem("admins"));
            console.log("Rendering account data:", userData);

            if (utenteIndex !== -1) {
                const user = userData //getUserDataById(userData, utenteIndex);
                if (user) {
                    accountInfoContainer.innerHTML = `
            <div class="account-info mb-4">
                <h2>Informazioni Account</h2>
                <div class="row">
                    <div class="col-sm-6">
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
                        
                    </div>

                    <div class="col-sm-6 p-0">
                        <button class="btn btn-primary" id="btn-logOut">Logout</button>
                    </div>
            </div>`;
                    const logoutBtn = document.getElementById("btn-logOut");
                    logoutBtn.addEventListener("click", () => {
                        setTimeout(function() {

                            localStorage.removeItem('admins');
                            window.location.reload();
                            window.location.href = "login-AdminDiscoverAI.php";

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