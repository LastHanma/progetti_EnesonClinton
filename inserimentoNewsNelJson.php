<?php

require_once "connesioneDatabase.php";
// Query per selezionare tutti i dati dalla tabella
$sql = "SELECT * FROM notizie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array per memorizzare i dati delle notizie
    $newsList = array();

    // Leggi i risultati della query
    while ($row = $result->fetch_assoc()) {
        // Aggiungi ogni riga ai dati delle notizie
        $newsList[] = $row;
    }

    // Scrivi i dati delle notizie nel file JSON
    if (file_put_contents("data.json", json_encode($newsList, JSON_PRETTY_PRINT)) !== false) {
        //echo "I dati sono stati scritti nel file JSON con successo.";
    } else {
        //echo "Si è verificato un errore durante la scrittura dei dati nel file JSON.";
    }
} else {
    echo "Nessun risultato trovato.";
}
