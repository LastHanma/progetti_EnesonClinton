<?php
require_once "connesioneDatabase.php";
session_start();
// Verifica se sono stati inviati dati tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
    // Verifica che siano stati inviati tutti i campi necessari
    if (isset($_POST['username']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Recupera i dati inviati dal modulo HTML
        $username = strtolower($_POST['username']); // Converte l'username in minuscolo
        $nome = trim($_POST['nome']); // Rimuove spazi bianchi all'inizio e alla fine del nome
        $cognome = trim($_POST['cognome']); // Rimuove spazi bianchi all'inizio e alla fine del cognome
        $email = strtolower(trim($_POST['email'])); // Converte l'email in minuscolo e rimuove spazi bianchi
        $passwordNormale  = $_POST["password"];
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash della password e rimozione degli spazi bianchi
        // Verifica se l'username o l'email esistono già nel database
        $query_check_existing = "SELECT * FROM utenti WHERE username = '$username' OR email = '$email'";
        $result_check_existing = $conn->query($query_check_existing);

        if ($result_check_existing->num_rows > 0) {
            // Se esiste già un record con lo stesso username o email, mostra un messaggio di errore
            echo '<div class="alert alert-warning" role="alert">Username o email già esistenti!</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "registrazione-Utente.php" }, 1000);';
            echo "</script>";
        } else {
            // Se l'username e l'email sono unici, procedi con l'inserimento dei dati nel database
            // Prepara una query per inserire i dati nella tabella utenti
            $query_inserimento = "INSERT INTO utenti (nome, cognome, username, email, pass) VALUES ('$nome', '$cognome','$username', '$email', '$password')";


            // Esegui la query
            if ($conn->query($query_inserimento) === TRUE) {
                // Ottieni l'ID dell'utente appena inserito
                $id_utente = $conn->insert_id;
                $_SESSION["utenteIndex"] = $id_utente; // Salva l'ID dell'utente appena inserito nel database
                $_SESSION["passwordNormale"] = $passwordNormale;
                $_SESSION['emailUtente'] = $email;
                echo '<div class="alert alert-success" role="alert">Registrazione eseguita con successo!</div>';
                require_once 'logged.php';
                // Percorso del file JSON
                $jsonFilePath = "utenti.json";


                // Aggiungi i dati del nuovo utente all'array
                $nuovoUtente = array(
                    'id_utente' => $id_utente,
                    'nome' => $nome,
                    'cognome' => $cognome,
                    'username' => $username,
                    'email' => $email,
                    'password' => $passwordNormale, // Password non criptata
                    'pass' => $password // Password criptata
                );

                // Leggi i dati dal file JSON se esiste
                if (file_exists($jsonFilePath)) {
                    $jsonData = file_get_contents($jsonFilePath);
                    $userDataJson = json_decode($jsonData, true);
                } else {
                    // Se il file non esiste, inizializza $userData come un array vuoto
                    $userDataJson = [];
                    echo "File inesistente";
                }

                // Aggiungi il nuovo utente all'array dei dati
                $userDataJson[] = $nuovoUtente;
                $userData[$id_utente] = $nuovoUtente;




                // Scrivi i dati JSON nel file
                file_put_contents($jsonFilePath, json_encode($userDataJson));

                // Salva i dati nel localStorage
                echo "<script>";
                echo "const userData = " . json_encode($userData[$id_utente]) . ";"; // Converti l'array PHP in un oggetto JavaScript
                echo "localStorage.setItem('utenti', JSON.stringify(userData));"; // Salva i dati dell'utente nel localStorage
                echo 'setTimeout(function() { window.location.href = "datelefono.php" }, 1500);';
                echo "</script>";
                exit();
            } else {
                //echo "Errore durante la registrazione: " . $conn->error;
                echo '<div class="alert alert-danger" role="alert">Errore durante la registrazione: !,' . $conn->error . '</div>';
                echo "<script>";
                echo 'setTimeout(function() { window.location.href = "datelefono.php" }, 1000);';
                echo "</script>";
            }


            // Chiudi la connessione al database
            $conn->close();
        }
    } else {
        // Se mancano dei campi, mostra un messaggio di errore
        echo '<div class="alert alert-warning" role="alert">Per favore, compila tutti i campi del modulo.</div>';
        echo "<script>";
        echo 'setTimeout(function() { window.location.href = "datelefono.php" }, 1000);';
        echo "</script>";
    }
}
