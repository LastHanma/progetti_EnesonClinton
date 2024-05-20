<?php
// Verifica che la richiesta sia di tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica che l'immagine sia stata caricata correttamente
    if (!empty($_FILES['image']['tmp_name'])) {
        // Percorso del file JSON
        $file_json = 'immagini.json';

        // Leggi il contenuto attuale del file JSON
        $json_content = file_get_contents($file_json);

        // Decodifica il contenuto JSON in un array associativo
        $images = json_decode($json_content, true);

        // Ottieni il percorso temporaneo dell'immagine caricata
        $image_tmp = $_FILES['image']['tmp_name'];

        // Genera un nome univoco per l'immagine
        $image_name = uniqid('image_') . '.png'; // Cambia l'estensione se necessario

        // Sposta l'immagine dalla sua posizione temporanea alla cartella di destinazione
        $destination = 'uploads/' . $image_name;
        if (move_uploaded_file($image_tmp, $destination)) {
            // Aggiungi il percorso dell'immagine all'array
            $images[] = $destination;

            // Codifica l'array aggiornato in formato JSON
            $json_content_updated = json_encode($images, JSON_PRETTY_PRINT);

            // Scrivi il contenuto JSON nel file
            if (file_put_contents($file_json, $json_content_updated) !== false) {
                // Invia una risposta JSON di successo
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }
}

// Invia una risposta JSON di errore se si verifica un problema
echo json_encode(['success' => false]);
