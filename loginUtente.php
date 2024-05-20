<?php
require_once "connesioneDatabase.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
    // Recupera i dati del modulo di login
    $emailUser = $_POST["emailUser"];
    $password = $_POST["password"];

    // Prepara la query per selezionare l'utente con l'email specificata
    $query = "SELECT id_utente, nome, cognome, username, email, pass FROM utenti WHERE email = '$emailUser' OR username = '$emailUser'";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Utente trovato, verifica la password
        $row = $result->fetch_assoc();
        $storedPassword = $row["pass"];

        if (password_verify($password, $storedPassword)) {
            $passwordNormale = $password;
            $_SESSION['loggato'] = true;
            // Salva l'indice dell'utente trovato nella sessione
            $_SESSION["utenteIndex"] = $row["id_utente"];
            $utenteIndex = $row["id_utente"];
            // Password corretta, autenticazione riuscita
            $_SESSION["emailUtente"] = $emailUser; // Memorizza l'email dell'utente nella sessione

            echo '<div class="alert alert-success" role="alert">Login eseguito con successo!</div>';

            // Aggiorna il file JSON degli utenti con il nuovo utente loggato
            $utenteLoggato = array(
                'id_utente' => $row['id_utente'],
                'nome' => $row['nome'],
                'cognome' => $row['cognome'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => $passwordNormale, // Password non criptata
                'pass' => $password // Password criptata
            );

            // Leggi il file JSON degli utenti
            $utentiJSON = file_get_contents("utenti.json");
            $utentiA = json_decode($utentiJSON, true);

            // Controlla se esiste già un utente con lo stesso id_utente o email
            $isDuplicate = false;
            foreach ($utentiA as $utente) {
                if ($utente['id_utente'] == $row['id_utente'] || $utente['email'] == $row['email']) {
                    $isDuplicate = true;
                    break;
                }
            }

            // Se non è un duplicato, aggiungi il nuovo utente
            if (!$isDuplicate) {
                $utentiA[] = $utenteLoggato;
                // Salva l'array aggiornato nel file JSON
                file_put_contents("utenti.json", json_encode($utentiA));
            }
            // Serializza e salva l'array aggiornato nello storage locale
            echo "<script>";
            echo "localStorage.setItem('utenti', JSON.stringify(" . json_encode($utentiA[$utenteIndex - 1]) . "));";
            echo "</script>";

            // Reindirizza l'utente
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "datelefono.php"; }, 1350);';
            echo "</script>";
        } else {
            $logged = false;

            // Password non corretta
            echo '<div class="alert alert-danger" role="alert">Password errata.</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "login-DiscoverAi.php"; }, 1000);';
            echo "</script>";
        }
    } else {
        // Nessun utente trovato con quell'email o username
        echo '<div class="alert alert-danger" role="alert">Nessun utente trovato con quell\'email o username.</div>';
        echo "<script>";
        echo 'setTimeout(function() { window.location.href = "login-DiscoverAi.php"; }, 1350);';
        echo "</script>";
    }
}

// Chiudi la connessione al database
$conn->close();
