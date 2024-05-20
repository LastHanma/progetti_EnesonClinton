<?php

// Includi le librerie PHPMailer
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "controlloSessione.php";
if (isset($_SESSION['utenteIndex'])) {

    $email = $_SESSION['emailUtente'];
    $username = $_SESSION['username'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
        // Recupera i dati inviati dal form
        $messaggio = $_POST['messaggio'];

        // Formattazione del corpo dell'email
        // Formattazione del corpo dell'email
        $emailContainerStyle = 'background-color: #f8f9fa; color: #343a40; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin: 0 auto; max-width: 600px;';
        $emailTitleStyle = 'font-family: \'Poppins\', sans-serif; font-size: 2.5rem; font-weight: bold; margin-bottom: 30px; color: #2a3f4d;'; // Colore blu scuro per il titolo
        $emailContentStyle = 'font-size: 1.1rem; margin-bottom: 30px; color: #6c757d;'; // Colore grigio scuro per il contenuto
        $logoStyle = 'font-size: 3rem; text-transform: uppercase; letter-spacing: 3px; font-weight: bold; color: #2a3f4d;'; // Colore blu scuro per il logo
        $logoUserStyle = 'color: #0d6efd;'; // Colore blu acceso per il logo dell'utente

        $emailContent = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Stili personalizzati */
        body {
            font-family: \'Poppins\', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-container {
            ' . $emailContainerStyle . '
        }
        .email-title {
            ' . $emailTitleStyle . '
        }
        .email-content {
            ' . $emailContentStyle . '
        }
        .logo {
            ' . $logoStyle . '
        }
        .User {
            ' . $logoUserStyle . '
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="email-container text-center">
                <h2 class="email-title">Messaggio da <span class="User">' . $username . '</span></span></h2>
                <div class="email-content">
                    <p class="mb-0"><strong>Email:</strong> ' . $email . '</p>
                    <hr style="border-top: 2px solid #2a3f4d; margin: 20px 0;">
                    <p class="mb-0"><strong>Messaggio:</strong></p>
                    <p>' . $messaggio . '</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
';
        //echo $emailContent;



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
            $mail->setFrom($email, 'DiscoverAI Contatti');
            $mail->addAddress('discoverAi5DI@gmail.com'); // Sostituisci con l'indirizzo al quale desideri inviare l'email
            $mail->Subject = 'Messaggio da Contatti';
            $mail->addReplyTo($email);
            // Aggiunta del corpo dell'email
            $mail->isHTML(true);
            $mail->Body = $emailContent;

            // Invio dell'email
            $mail->send();
            echo '<div class="alert alert-success" role="alert">Email inviata con successo!</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "contatti.php"; }, 1000);';
            echo "</script>";
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">Errore durante l"invio dell"email: ' .  $mail->ErrorInfo . '</div>';
            echo "<script>";
            echo 'setTimeout(function() { window.location.href = "contatti.php"; }, 1000);';
            echo "</script>";
        }
    }
}
