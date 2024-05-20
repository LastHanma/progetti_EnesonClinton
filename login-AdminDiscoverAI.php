<?php
require_once "connesioneDatabase.php";

/* Controlla se l'utente è autenticato e ha effettuato l'accesso
session_start();
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    echo $userId;
    // Prepara la query per selezionare solo le informazioni dell'utente autenticato
    $query = "SELECT nome, cognome, username, email, pass FROM utenti WHERE id = $userId";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc();
        echo json_encode($userData);
    } else {
        echo json_encode(array("error" => "Nessun utente trovato con l'ID specificato"));
    }
} else {
    //echo json_encode(array("error" => "Utente non autenticato"));
}*/
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        body {
            height: 100vh;
            overflow: hidden;
            /* Evita lo scroll */
            position: relative;
            /* Rendi relativo per posizionare l'overlay */
        }

        html::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(discoverAI.jpg);
            background-size: cover;
            filter: blur(3px);
            /* Applica lo sfocatura */
            z-index: -1;
            /* Porta l'overlay dietro a tutti gli altri contenuti */
        }

        .logo-brand {
            font-size: 5rem;
            text-transform: uppercase;
            letter-spacing: 8.5px;
            font-weight: bold;
            margin-bottom: 100px;
            color: white;
        }

        .logoAi {
            color: #566b78 !important;
        }

        .btn {
            background-color: #566b78;
            color: white;
            font-weight: bold;
        }

        .btn:hover {
            color: white;
        }

        label,
        p {
            color: white;
        }

        .login-box {
            max-width: 450px;
            margin-inline: auto;
        }

        @media (min-width: 320px) {
            .logo-brand {
                font-size: 2.3rem;
            }
        }

        @media (min-width: 400px) {
            .logo-brand {
                font-size: 3.2rem;
            }
        }

        @media (min-width: 768px) {
            .logo-brand {
                font-size: 4.5rem;
            }
        }
    </style>
</head>

<body>
    <h1 class="logo-brand text-center mt-5" href="#">
        discover<span class="logoAi">AI</span></span>
    </h1>

    <form action="gestioneLoginAdmin.php" class="login-box mx-auto" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="emailUser" name="emailAdmin" aria-describedby="emailHelp" required />

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="btn-box">
            <button type="submit" id="" class="btn w-100">Login</button>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    buttonLogin = document.getElementById("btn-login");
    async function login() {
        const response = await fetch("utenti.json");
        const data = await response.json();
        if (data) {
            localStorage.setItem("utente", JSON.stringify(responseJSON))
            window.location.href = "account-Utente.php"
        } else {
            console.log("Utente non trovato")
        }

    }
    buttonLogin.addEventListener("click", () => {
        login();
    });
</script>

</html>