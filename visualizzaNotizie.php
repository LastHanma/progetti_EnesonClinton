<?php
// Leggi i dati dal file notizie.json
$data = file_get_contents("data.json");
$newsList = json_decode($data, true);

// Invia le notizie come JSON
header('Content-Type: application/json');
echo json_encode($newsList);
