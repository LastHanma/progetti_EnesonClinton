<?php
// Connessione al database (sostituisci con i tuoi dati di connessione)
require_once "connesioneDatabase.php";

// Includi le librerie PHPMailer
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Definisci il tuo client ID e client secret Imgur
$client_id = 'c6f1444787fa275';
$client_secret = '0e8b06f05ee9abdc06e69d84d83d9b4922d23348';

// Verifica se il metodo di richiesta è POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
    // Verifica che tutti i campi del modulo siano stati compilati
    if (!empty($_FILES['image']['tmp_name']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['link'])) {

        // Percorso della cartella in cui salvare l'immagine caricata
        $targetDir = "uploads/";

        // Verifica se la cartella uploads esiste, altrimenti creala
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Crea la cartella con i permessi di scrittura
        }

        // Percorso completo del file immagine caricato
        $targetFilePath = $targetDir . basename($_FILES["image"]["name"]);

        // Ottieni l'estensione del file
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Controlla se il file è un'immagine effettiva
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Continua solo se il file è un'immagine
            // Imposta un nuovo nome univoco per l'immagine
            $newFileName = uniqid() . '.' . $imageFileType;
            $targetFilePath = $targetDir . $newFileName;

            // Salva l'immagine nella cartella specificata
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // L'immagine è stata caricata con successo, ora inseriamo i dati nel database

                // Prendi i dati inviati dal modulo
                $title = htmlspecialchars($_POST['title']);
                $description = htmlspecialchars($_POST['description']);
                $link = htmlspecialchars($_POST['link']);

                // Recupera l'id_utente dalla sessione
                require_once "controlloSessione.php";

                // Verifica se l'utente è autenticato
                if (isset($_SESSION['utenteIndex'])) {
                    $id_utente = $_SESSION['utenteIndex'];
                    $email = $_SESSION['emailUtente'];
                } else {
                    // L'utente non è autenticato
                    //echo "Utente non autenticato.";
                    echo '<div class="alert alert-danger" role="alert">Utente non autenticato.</div>';
                    echo "<script>";
                    echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                    echo "</script>";
                    exit; // Esci dallo script per evitare ulteriori operazioni
                }

                // Query per inserire i dati nel database
                $sql = "INSERT INTO notizie (image_url, titolo, descrizione, link, id_utente) VALUES ('$targetFilePath', '$title', '$description', '$link', $id_utente)";

                if ($conn->query($sql) === TRUE) {
                    //echo "I dati sono stati salvati con successo.";
                    echo '<div class="alert alert-success" role="alert">I dati sono stati inviati con successo.</div>';
                    echo "<script>";
                    echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                    echo "</script>";

                    require_once "inserimentoNewsNelJson.php";

                    // URL per ottenere il token OAuth
                    $url = 'https://api.imgur.com/oauth2/token';

                    // Dati da inviare nella richiesta POST per ottenere il token
                    $postData = array(
                        'client_id' => $client_id,
                        'client_secret' => $client_secret,
                        'grant_type' => 'client_credentials'
                    );

                    // Inizializza cURL
                    $ch = curl_init();

                    // Imposta le opzioni della richiesta cURL
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // Esegui la richiesta cURL
                    $response = curl_exec($ch);

                    // Controlla se ci sono errori
                    if ($response === false) {
                        echo 'Errore cURL: ' . curl_error($ch);
                        exit;
                    }

                    // Decodifica la risposta JSON
                    $result = json_decode($response, true);

                    // Verifica se è stato ottenuto con successo un token OAuth
                    if (isset($result['access_token'])) {
                        // Il token OAuth è stato ottenuto con successo
                        $access_token = $result['access_token'];

                        // Formattazione del corpo dell'email
                        $emailTitleStyle = 'font-family: \'Roboto\', sans-serif; font-size: 1.5rem; font-weight: bold; margin-bottom: 20px;';
                        $emailContent = '
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="utilità-generali.css">
    </head>
    <body>
        <div style="background-color: #f8f9fa; color: #343a40; padding: 20px; font-family: \'Roboto\', sans-serif;">
            <h2 style="' . $emailTitleStyle . '">Messaggio da DiscoverAI</h2>
            <div style="font-size: 1rem;">
                <p><strong>Email:</strong> ' . $email . '</p>
            </div>
        </div>
        <div class="card" style="max-width: 18rem;">
            <img src="' . $targetFilePath . '" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <p class="card-text">' . $description . '</p>
                <a href="' . $link . '" class="btn btn-primary">Leggi di più</a>
            </div>
        </div>
    </body>
    </html>';

                        // Configurazione dell'email
                        $mail = new PHPMailer(true);
                        try {
                            // Configurazione del server SMTP e altri dettagli dell'email
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'lasthanma@gmail.com';
                            $mail->Password = 'mtnjtvvvjdtjbnap';
                            $mail->SMTPSecure = 'ssl'; // Usa 'tls' se richiesto
                            $mail->Port = 465; // Porta SMTP di Gmail (può essere 587 per TLS)

                            // Impostazione dei dettagli dell'email
                            $mail->setFrom('lasthanma@gmail.com', 'DiscoverAI Contatti');
                            $mail->addAddress($email); // Sostituisci con l'indirizzo al quale desideri inviare l'email
                            $mail->Subject = 'Messaggio da Contatti';

                            // Aggiunta del corpo dell'email
                            $mail->isHTML(true);
                            $mail->Body = $emailContent;

                            // Invio dell'email
                            $mail->send();
                            //echo 'Email inviata con successo!';
                            echo '<div class="alert alert-success" role="alert">Email inviata con successo!</div>';
                            echo "<script>";
                            echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                            echo "</script>";
                        } catch (Exception $e) {
                            //echo 'Errore durante l\'invio dell\'email: ', $mail->ErrorInfo;
                            echo '<div class="alert alert-danger" role="alert">Errore durante l"invio dell"email: ' .  $mail->ErrorInfo . '</div>';
                            echo "<script>";
                            echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                            echo "</script>";
                        }
                    } else {
                        // Non è stato possibile ottenere il token OAuth, gestisci l'errore di conseguenza
                        //echo 'Impossibile ottenere il token OAuth';
                        echo '<div class="alert alert-danger" role="alert">Impossibile ottenere il token OAuth</div>';
                        echo "<script>";
                        echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                        echo "</script>";
                    }
                } else {
                    //echo "Errore durante l'inserimento dei dati nel database: " . $conn->error;
                    echo '<div class="alert alert-danger" role="alert">Errore durante l"inserimento dei dati nel database: " ' . $conn->error . '</div>';
                    echo "<script>";
                    echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                    echo "</script>";
                }
            } else {
                //echo "Si è verificato un errore durante il caricamento dell'immagine.";
                echo '<div class="alert alert-danger" role="alert">Si è verificato un errore durante il caricamento dell"immagine</div>';
                echo "<script>";
                echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
                echo "</script>";
            }
        } else {
            //echo "Il file non è un'immagine valida.";
            echo '<div class="alert alert-warning" role="alert">Il file non è un"immagine valida.</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
            echo "</script>";
        }
    } else {
        //echo "Per favore, compila tutti i campi del modulo.";
        echo '<div class="alert alert-warning" role="alert">Per favore, compila tutti i campi del modulo.</div>';
        echo "<script>";
        echo 'setTimeout(function() { window.location.href = "newsUtente.php"; }, 1000);';
        echo "</script>";
    }
} else {
    echo "Metodo non consentito";
}

// Chiudi la connessione al database
$conn->close();
