<?php
require_once "connesioneDatabase.php";

// Controlla se l'utente è autenticato e ha effettuato l'accesso
session_start();
if (isset($_SESSION["utenteIndex"])) {
    //echo $_SESSION['utenteIndex'] . '<br>';
    //echo 'aoo' . $_SESSION['loggato'];
    $userId = $_SESSION["utenteIndex"];
    // Prepara la query per selezionare solo le informazioni dell'utente autenticato
    $query = "SELECT id_utente,nome, cognome, username, email, pass FROM utenti WHERE id_utente = '$userId'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc();
        $_SESSION['utenteIndex'] = $userData['id_utente'];
        $_SESSION['emailUtente'] = $userData['email'];
        $_SESSION['username'] = $userData['username'];
    }
} else {

    echo "Nessun Dato trovato nella Sessione ;<br>";
    echo "<script>";
    echo 'setTimeout(function() { window.location.href = "homepage-DiscoverAI.php"; }, 100350);';
    echo "</script>";
}
