<?php
// Configurazione della connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "discover_ai";

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
