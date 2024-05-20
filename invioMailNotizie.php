<?php

// Includi le librerie PHPMailer
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal form
    $email = $_POST['email'];
    $messaggio = $_POST['messaggio'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    // Carica l'immagine caricata
    $image = $_FILES['image']['tmp_name'];
    $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $imageBase64 = 'data:image/' . $imageFileType . ';base64,' . base64_encode(file_get_contents($image));

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
                <p><strong>Messaggio:</strong><br>' . $messaggio . '</p>
            </div>
        </div>
        <div class="card" style="max-width: 18rem;">
            <img src="' . $imageBase64 . '" class="card-img-top" alt="Image">
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
        echo 'Email inviata con successo!';
    } catch (Exception $e) {
        echo 'Errore durante l\'invio dell\'email: ', $mail->ErrorInfo;
    }
}
