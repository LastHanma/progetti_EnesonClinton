<?php
$username = "username"; // Username dell'utente
$email = "email@example.com"; // Esempio di indirizzo email
$messaggio = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero."; // Esempio di messaggio

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

echo $emailContent;
