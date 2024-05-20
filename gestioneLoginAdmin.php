<?php
require_once "connesioneDatabase.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
    // Recupera i dati del modulo di login
    $emailAdmin = $_POST["emailAdmin"];
    $password = $_POST["password"];

    $query = "SELECT id_admin,username,email,pass FROM amministratori WHERE email = '$emailAdmin' OR username = '$emailAdmin'";

    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        // Utente trovato, verifica la password
        $row = $result->fetch_assoc();
        $storedPassword = $row["pass"];

        if (password_verify($password, $storedPassword)) {
            $passwordNormale = $password;
            $_SESSION['loggato'] = true;
            // Salva l'indice dell'utente trovato nella sessione
            $_SESSION["utenteIndex"] = $row["id_admin"];
            // Password corretta, autenticazione riuscita
            $_SESSION["emailAdmin"] = $emailAdmin; // Memorizza l'email dell'utente nella sessione

            echo '<div class="alert alert-success" role="alert">Login eseguito con successo!</div>';

            // Recupera l'array degli utenti dal file JSON
            $adminsJSON = file_get_contents("admins.json");
            $admins = json_decode($adminsJSON, true);

            // Supponiamo che $utenteIndex contenga l'indice dell'utente che vuoi aggiornare
            $utenteIndex = 1; // Ad esempio

            // Aggiungi il nuovo utente all'array
            $adminLoggato = array(
                'id_admin' => $row['id_admin'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => $passwordNormale, // Password non criptata
                'pass' => $row['pass']  // Password criptata
            );

            // Aggiorna l'utente nell'array
            $admins[$utenteIndex] = $adminLoggato;



            // Serializza e salva l'array aggiornato nello storage locale
            echo "<script>";
            echo "localStorage.setItem('admins', JSON.stringify(" . json_encode($admins[$utenteIndex]) . "));";
            echo "</script>";


            // Reindirizza l'utente
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "homepageAdmin.php"; }, 1350);';
            echo "</script>";
        } else {
            $logged = false;

            // Password non corretta
            echo '<div class="alert alert-danger" role="alert">Password errata.</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "login-AdminDiscoverAI.php"; }, 1000);';
            echo "</script>";
        }
    } else {

        // Nessun utente trovato con quell'email o username
        echo '<div class="alert alert-danger" role="alert">Nessun utente trovato con quell email</div>';
        echo "<script>";
        echo 'setTimeout(function() { window.location.href = "login-AdminDiscoverAI.php"; }, 1350);';
        echo "</script>";
    }
}

// Chiudi la connessione al database
$conn->close();
