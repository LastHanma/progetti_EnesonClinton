<?php
require_once "connesioneDatabase.php";
require_once "controlloSessione.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
  echo '<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>';
  echo '<style>
        .bi {
          width: 34px; 
          height: 34px;
        }
      </style>';
  // Recupera i dati inviati dal modulo di aggiornamento
  $nome = trim($_POST["nome"]);
  $cognome = trim($_POST["cognome"]);
  $username = trim(strtolower($_POST["username"]));
  $email = trim(strtolower($_POST["email"]));
  $nuovaPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
  $idUtente = $_SESSION['utenteIndex'];

  $query_update = "UPDATE utenti SET nome='$nome', cognome='$cognome', username='$username', email='$email', pass='$nuovaPassword' WHERE id_utente='$idUtente'";

  if ($conn->query($query_update)) {
    // Recupera l'array degli utenti dal file JSON
    $utentiJSON = file_get_contents("utenti.json");
    $utenti = json_decode($utentiJSON, true);

    // Cerca l'utente nel JSON
    $utenteIndex = array_search($idUtente, array_column($utenti, 'id_utente'));

    // Aggiorna i dati dell'utente nel JSON
    $utenti[$utenteIndex]['nome'] = $nome;
    $utenti[$utenteIndex]['cognome'] = $cognome;
    $utenti[$utenteIndex]['username'] = $username;
    $utenti[$utenteIndex]['email'] = $email;
    $utenti[$utenteIndex]['pass'] = $nuovaPassword;

    // Salva l'array aggiornato nello storage locale
    file_put_contents("utenti.json", json_encode($utenti));

    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2 p-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
              Dati aggiornati con successo!
            </div>
          </div>';

    echo '<script>
            setTimeout(function() {
                localStorage.removeItem("utenti");
                window.location.reload();
                window.location.href = "login-DiscoverAi.php";
            }, 1500); // Ritardo di 1.5 secondi (1500 millisecondi)
        </script>';
  } else {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Errore durante l\'aggiornamento dell\'account
            </div>
          </div>';
  }
} else {
  // Gestione del caso in cui il metodo della richiesta non sia POST
}
$conn->close();
