<?php
require "connesioneDatabase.php";


$username = 'admin1';
$email = 'admin1@gmail.com';
$pass = password_hash('admin10', PASSWORD_DEFAULT);

$query_insert = "INSERT INTO amministratori(username,email,pass) VALUES('$username','$email','$pass');";

if ($conn->query($query_insert) === TRUE) {
    echo "Record inserito con successo";
    echo '<div class="alert alert-success" role="alert">Registrazione eseguita con successo!</div>';
    // Prepara la query per selezionare l'utente con l'email specificata
    $query = "SELECT id_admin,username,email,pass FROM amministratori WHERE email = 'admin1@gmail.com' OR username = 'admin1'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        // Utente trovato, verifica la password
        $row = $result->fetch_assoc();
        // Aggiungi il nuovo utente all'array
        $jsonFilePath = "admins.json";
        $adminLoggato = array(
            'id_admin' => $row['id_admin'],
            'username' => $row['username'],
            'email' => $row['email'],
            // Password non criptata
            'pass' => $row['pass']  // Password criptata
        );
        if (file_exists($jsonFilePath)) {
            $jsonData = file_get_contents($jsonFilePath);
            $userData = json_decode($jsonData, true);
        } else {
            // Se il file non esiste, inizializza $userData come un array vuoto
            $admins = [];
            echo '<div class="alert alert-danger" role="alert">File inesistente</div>';
        }
        $admins[] = $adminLoggato;
        // Converti l'array in formato JSON
        $jsonData = json_encode($admins);
        // Scrivi i dati JSON nel file
        file_put_contents($jsonFilePath, $jsonData);
        exit();
    }
} else {
    echo "Errore durante l'inserimento del record: " . $conn->error;
}
$conn->close();
