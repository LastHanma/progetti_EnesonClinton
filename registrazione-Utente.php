<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrazione-DiscoverAI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <style>
        html,
        body {
            /* Imposta altezza e overflow del body e dell'html */
            height: 100vh;
            overflow: auto;
            /* Evita lo scroll */
            margin: 0;
            /* Rimuove il margine predefinito */
            padding: 0;
            /* Rimuove il padding predefinito */
        }

        body {
            /* Imposta il background */
            background-image: url(discoverAI.jpg);
            background-size: cover;
            /* Copre l'intera area del body */
            background-repeat: no-repeat;
            /* Evita la ripetizione dello sfondo */
            position: relative;
            /* Rendi relativo per posizionare gli elementi figlio */
        }

        html::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(discoverAI.jpg);
            /* Usa lo stesso sfondo del body */
            background-size: cover;
            filter: blur(3px);
            /* Applica lo sfocatura */
            z-index: -1;
            /* Porta l'overlay dietro a tutti gli altri contenuti */
        }

        .logo-brand {
            font-size: 5rem;
            text-transform: uppercase;
            letter-spacing: 8.5px;
            font-weight: bold;
            margin-bottom: 100px;
            color: white;
        }

        .logoAi {
            color: #566b78 !important;
        }

        .btn {
            background-color: #566b78;
            color: white;
            font-weight: bold;
        }

        .btn:hover {
            color: white;
        }

        label,
        p {
            color: white;
        }

        .login-box {
            max-width: 450px;
            margin-inline: auto;
            padding: 1.5rem;
        }

        @media (min-width: 320px) {
            .logo-brand {
                font-size: 2.3rem;
            }
        }

        @media (min-width: 400px) {
            .logo-brand {
                font-size: 3.2rem;
            }
        }

        @media (min-width: 768px) {
            .logo-brand {
                font-size: 4.5rem;
            }
        }
    </style>
</head>

<body>
    <h1 class="logo-brand text-center mt-5" href="#">
        discover<span class="logoAi">AI</span></span>
    </h1>

    <form action="inserimentoUtente.php" class="login-box mx-auto" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" maxlength="20" required />
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required />
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cognome</label>
            <input type="text" class="form-control" id="cognome" name="cognome" required />
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required aria-describedby="emailHelp" />

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3 form-check pl-0">
            <a href="login-DiscoverAi.php">Ha già un account?clicca qui per accedere</a>
        </div>
        <div class="btn-box">
            <button type="submit" class="btn w-100">registrati</button>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script></script>

</html>