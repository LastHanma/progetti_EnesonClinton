<?php

// Verifica che l'ID della notizia sia stato ricevuto
if (isset($_GET['newsId'])) {
    // Ricevi l'ID della notizia dalla richiesta HTTP
    $newsId = $_GET['newsId'];

    require_once "connesioneDatabase.php";

    // Query SQL per eliminare la notizia dalla tabella
    $sql = "DELETE FROM notizie WHERE id_notizia = $newsId";

    // Esegui la query
    if ($conn->query($sql) === TRUE) {

        // Percorso del file JSON
        $jsonFile = 'data.json';

        // Leggi il contenuto del file JSON
        $jsonData = file_get_contents($jsonFile);

        // Decodifica il JSON in un array associativo
        $newsList = json_decode($jsonData, true);

        // Cerca l'indice dell'elemento da eliminare
        $index = array_search($newsId, array_column($newsList, 'id_notizia'));

        if ($index !== false) {
            // Rimuovi l'elemento dalla lista
            unset($newsList[$index]);

            // Codifica l'array aggiornato in JSON
            $updatedJsonData = json_encode(array_values($newsList));

            // Scrivi i dati aggiornati nel file JSON
            file_put_contents($jsonFile, $updatedJsonData);

            // Rispondi con un messaggio di successo
            http_response_code(200);
            // Notizia eliminata con successo
            echo json_encode(["message" => "Notizia eliminata con successo."]);
            echo json_encode(array("success" => true));
        } else {
            // Errore durante l'eliminazione della notizia
            echo json_encode(array("error" => "Errore durante l'eliminazione della notizia: " . $conn->error));
        }

        // Chiudi la connessione al database
        $conn->close();
    } else {
        // Se l'ID della notizia non è stato ricevuto
        echo json_encode(array("error" => "ID della notizia non specificato."));
    }
}
